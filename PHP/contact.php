<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Contact Page</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
   <link href="https://fonts.googleapis.com/css?family=Fredoka" rel="stylesheet">
   <link rel="stylesheet" href="../CSS/mainStyle.css">
   <script src="../JS/eventHandling.js"></script>
</head>

<body class="background">

   <!-- Header and Navbar -->
   <?php include '../PHP/navbar.php'; ?>


   <h2 class="page-name">CONTACT US</h2>

   <div class="row">
      <div class="contact-form">
         <h3 onmouseover="this.style.color='#f5c6d3'" onmouseout="this.style.color='black'">SEND YOUR MESSAGE</h3>

         <form id="cform" action="../PHP/storMsgInfo.php" method="POST">
             
            <div class="hint" id="snameHint">Please enter your full name.</div>
            <input type="text" name="senderName" placeholder="Name" id="sname" onfocus="myFocus(this.id)" onblur="myBlu(this.id)" required><br><br>   
            
            <div class="hint" id="semailHint">Enter a valid email address (e.g., user@example.com).</div>
            <input type="email" name="senderEmail" placeholder="Email" id="semail" onfocus="myFocus(this.id)" onblur="myBlu(this.id)" required><br><br>

            <div class="hint" id="ssubHint">Provide a short subject for your message.</div>
            <input type="text" name="mesSubject" placeholder="Subject" id="ssub" onfocus="myFocus(this.id)" onblur="myBlu(this.id)" required><br><br>

            <div class="hint" id="msgHint">Write your message here.</div>
            <textarea placeholder="Message" id="msg" name="message" minlength="15" onfocus="myFocus(this.id)" onblur="myBlu(this.id)" required></textarea><br><br>
            
            <input type="submit" id="send" value="Send Message">
            <input type="reset" id="cancel" value="Cancel"><br><br>

         </form>
      </div>

      <div class="contact-info">
         <h3 onmouseover="this.style.color='#f5c6d3'" onmouseout="this.style.color='black'" ondblclick="dClickFunction()">GET IN TOUCH</h3>
         <p id="hiddenPar">Feel free to contact us any time. We will get <br> back to you as soon as we can!!</p>

         <div class="concatenate-two-para">
            <p>
               <i class="fas fa-phone"></i>
               <strong>PHONE</strong><br>
               <a href="tel:+1234561234">+123-456-1234</a>
            </p>

            <p>
               <i class="fas fa-envelope"></i>
               <strong>EMAIL</strong><br>
               <a href="mailto:EUPoria00@euphoriasite.com">EUPoria00@euphoriasite.com</a>
            </p>
         </div>

         <div class="concatenate2-two-para">
            <p>
               <i class="fas fa-globe"></i>
               <strong>WEBSITE</strong><br>
               <a href="http://www.euphoriasite.com" target="_blank">www.euphoriasite.com</a>
            </p>

            <p>
               <i class="fas fa-map-marker-alt"></i>
               <strong>ADDRESS</strong><br>
               <a href="https://maps.app.goo.gl/nA3VHmunfrxFEbTr6" target="_blank">AR Rayaan District, Jeddah 23741</a>
            </p>
         </div>

      </div>

   </div>
   
   <div class="row2">
      <footer class="footer">
         <div class="footer-content">
            <div class="row">
               <div class="column">
                  <img src="../images/logo.png" alt="Vanilla Dream" class="logo-footer">
               </div>

               <div class="column">
                  <h5>Visit Us</h5>
                  <p>123 Cupcake Street, Sweet City</p>
               </div>

               <div class="column">
                  <h5>Follow Us</h5>
                  <div class="social-icons">
                     <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                     <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                     <a href="tel:+1234567890"><i class="fas fa-phone"></i></a>
                  </div>
               </div>

               <div class="column">
                  <h5>Our Menu</h5>
                  <ul class="description-footer">
                     <li>Chocolate Cupcakes</li>
                     <li>Vanilla Delights</li>
                     <li>Red Velvet Bliss</li>
                  </ul>
               </div>
            </div>

            <div class="row">
               <hr class="footer-line" />
            </div>

            <p class="footer-copyright">
               &copy; <?php echo date('Y'); ?> Cupcake Heaven. All rights reserved.
            </p>

         </div>
      </footer>
   </div>

</body>

</html>
