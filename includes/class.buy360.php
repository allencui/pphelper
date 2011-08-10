<?PHP
    class buy360
    {
        
        private static $me;

        public $url;
		
		//check url
		public function isValidUrl($url){
			if ((strpos($url,"360buy.com")>0) && (substr($url,0,4)=="http"))
				return true;
			else
				return false;
		}
			
		//check url type: product or other
		public function isProductUrl($url){
			if ((preg_match('/\/[0-9]+.html$/', $url, $matches,0)==1) && (strpos($url,"brand")==false))
				return true;
			else
				return false;
		}
		
		//crawl-able?
		public function crawlThis($url){
			return @file_get_contents($url,false,null);		
		}
		
		//get product info: title and price
		public function getProductInfo($url){
			$pinfo=array("pid"=>"","title"=>"","price"=>"","url"=>"");
			//
			$result=self::crawlThis($url);
			//crawled html content
			if (strlen($result)>0) {
			//product info are from the script
			$startpos=strpos($result,"非常不错的商品：");
			if ($startpos>1){
					$endpos=strpos($result,"感觉不错，分享一下");
					$pinfo=substr($result,$startpos+16,$endpos-$startpos-16);
					
					$ptitle=substr($pinfo,0,strpos($pinfo,"京东价"));
					$ptitle=substr($ptitle,0,strlen($ptitle)-2); //the ful comma in the end
					$pprice=str_replace("。","",substr($pinfo,strpos($pinfo,"京东价")+8));
					$pid=str_replace(".html","",substr($url,strrpos($url,"/")+1));
					$pinfo=array("pid"=>$pid, "title"=>$ptitle, "price" =>$pprice,"url"=>$url);
					
					//echo  "<table><tr><td><a href=\"".$url."\">".$ptitle."</a></td><td>". $pprice."</td></tr></table>";
				}
				else
				{
					//echo "Cannot get price for given product. Please report this issue.";
					
				}
			}
			else
			{
				//echo "Crawler failed!";
			}
		return $pinfo;
		}
		
		//get all product urls from the given page
		public function getProductList($url){
			
			$titles=array();
			$urls=array();
			$pids=array();
			
			//$plist=array($titles,$urls);
			
			$result=self::crawlThis($url);
			//crawled html content
			if (strlen($result)>0) {
			
				if (($url=="http://www.360buy.com") || ($url="http://www.360buy.com/")) 
					$result=str_replace(".p-name","",$result);  //
				$curpname=strpos($result,"p-name");
				$lstpname=strrpos($result,"p-name");
				$i=0;  //counter	
				if (($curpname>0) && ($curpname<$lstpname)) {
					//echo "<table>";
					while ($curpname) {
						//get product title and url
						$ptitle=substr($result,$curpname + 8, strpos($result,"</div>", $curpname+1) - $curpname);
						$ptitle=str_replace("<d","",str_replace("target=_blank","",str_replace("'","",str_replace("\"","",$ptitle))));
						$purl=substr($ptitle,strpos($ptitle,"http://"),strpos($ptitle,".html",strpos($ptitle,"http://"))+5-strpos($ptitle,"http://"));
						$ptitle=substr($ptitle,strpos($ptitle,">")+1,strpos($ptitle,"<",strpos($ptitle,">"))-strpos($ptitle,">")-1);
						
						$pid=str_replace(".html","",substr($purl,strrpos($purl,"/")+1));
						
						if (strlen($pid)>0) {  //no pid, no saving						
							//get product info then
							$titles[$i]=$ptitle;
							$urls[$i]=$purl;
							$pids[$i]=$pid;

							$curpname=strpos($result,"p-name",$curpname+1);
							$i++;
						}
					}	
					//echo "</table>";	
				}
				else
				{	
					//echo "Cannot get the products info. Please report this issue.";
				}
			}
			else
			{	
				//echo "Cannot get the product list. Please report this url.";
			}
			
			return array($pids,$titles,$urls);
		}
    }
