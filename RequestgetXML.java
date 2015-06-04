import java.io.*;
import java.util.*;
import javax.servlet.*;
import javax.servlet.http.*;
import net.sf.json.JSON;
import net.sf.json.JSONObject;
import net.sf.json.xml.XMLSerializer;  
import java.net.URL;
import java.net.URLEncoder;
import java.net.URLConnection;
import java.net.MalformedURLException;
public class RequestgetXML extends HttpServlet {
    public void doGet(HttpServletRequest request, HttpServletResponse response)
		throws IOException, ServletException
 //public class  RequestgetXML {
//	public static void main(String[] args) throws Exception
    {
		String location=request.getParameter("location");	
		String type=request.getParameter("type1");
		String Type=type.replaceAll(" ", "%20");
		String Location=location.replaceAll(" ","%20");
		String temperature=request.getParameter("temperature");
        response.setContentType("application/json;charset=UTF-8");
        PrintWriter out = response.getWriter();
	   //url send to AWS
	    String urlString1="http://default-environment-26fip2hbrq.elasticbeanstalk.com/index.php?location="+Location+"&type1="+Type+"&temperature="+temperature;       
      // String urlString1 = "http://default-environment-26fip2hbrq.elasticbeanstalk.com/index.php?location=90007&type1=ZIP%20Code&temperature=Fahrenheit";
	//   String urlString=URLEncoder.encode(urlString1,"UTF-8");
      
         try{
	  	 URL url=new URL(urlString1);
		InputStream stream = url.openStream(); 
		XMLSerializer serializer = new XMLSerializer();
		JSON json = serializer.readFromStream(stream);
		out.println(json.toString(2));
		stream.close();
	}
 
	catch(MalformedURLException ex) {System.out.println("Bad URL");System.exit(1);}
	catch(IOException ex){System.out.println("IOException occured.");System.exit(1);}

}
}


