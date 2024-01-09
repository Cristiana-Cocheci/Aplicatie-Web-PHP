<html>
  <head>
    <link rel="stylesheet" href="login.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>neverlanes contact</title>
    <meta charset="utf-8">
    <meta name="autor" content="cristi">
    <meta name="description" content="pagina web?">
    <meta name="keywords" content="neverlanes">
 </head>
 <body>
  <div class="coloana" id="coloana1"><img src="coloana.png" alt="greek column"></div>
  <div class="pagina">
      <div class="header">
          <h1>
              NEVERLANES
          </h1>
          <div class="subtitle">
            <h2>LOGIN</h2>
          </div>
      </div>
      
      <div class="menu">
          <ul>
              <li><a href="home_page.php">HOMEPAGE</a></li>
              <li><a href="my_account_check.php">MY ACCOUNT</a></li>
          </ul>
      </div>
    
      <FORM method="POST" action="contact_check.php">
        <table border=0 width="40%" align="left">
        <tr>
        <tr>
              <td>First Name*: </td>
              <td><INPUT TYPE="text" name="first_name"></td>
          </tr>
          <tr>
              <td>Last Name*: </td>
              <td><INPUT TYPE="text" name="last_name"></td>
          </tr>
          <tr>
              <td>Email*: </td>
              <td><INPUT TYPE="email" name="email"></td>
          </tr>
            <td>Do you have an account?</td>
            <td><select name="user?">
                <option SELECTED VALUE="not_user">No account</option>
                <option Value="user">I have an account</option>
             </select>
                </td>
        </tr>
          <tr>
              <td>Username (if applicable): </td>
              <td><INPUT TYPE="text" name="username"></td>
          </tr>
          <tr>
              <td>Password (if applicable): </td>
              <td><INPUT TYPE="text" name="password"></td>
          </tr>
         <tr>
            <td>Message: </td>
            <td><textarea id="message" name="message" rows="4" cols="50">Write your message here.</textarea></td>
        </tr>
        
          <tr>
            <td colspan="2" class ="captcha-container">
          <div class="g-recaptcha" data-sitekey="6LcNjTwpAAAAALqWaouU89rRxpIV926v3Ck-ZTvM"></div>
          </td>
          </tr>
          <tr>
            <td><INPUT TYPE="reset" VALUE="reset"></td>
            <td><INPUT TYPE="submit" VALUE="send"></td>
          </tr>
          
         </table>
                </form>
         
         <div class="harta">
          Don't have an account?
          <a href="create_account.html">Create account</a>
         </div>
  </div>
  
 <div class="coloana" id="coloana2">
  <img src="coloana.png" alt="greek column">
 </div>
</body>

</html>
