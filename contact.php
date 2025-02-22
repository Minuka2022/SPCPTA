<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="res/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="res/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="res/img/favicon-16x16.png">
<link rel="manifest" href="res/img/site.webmanifest">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./style/animate.css">
    <link rel="stylesheet" href="./style/contacts.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include EmailJS -->
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>

    <title>Contact-us</title>
</head>
<body>


<?php include 'navbar.php'; ?>

<div class="contact_us_green">
  <div class="responsive-container-block big-container">
    <div class="responsive-container-block container">
      <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-7 wk-ipadp-10 line" id="i69b-2">
        <form class="form-box" id="contactForm">
        <div class="container-block form-wrapper">
            <div class="head-text-box">
                <p class="text-blk contactus-head">Contact us</p>
                <p class="text-blk contactus-subhead">
                    Should you have any concern or clarifications, feel free to email us and we will get in touch with you.
                </p>
            </div>
            <div class="responsive-container-block">
                <div class="responsive-cell-block wk-ipadp-6 wk-tab-12 wk-mobile-12 wk-desk-6" id="i10mt-6">
                    <p class="text-blk input-title">FIRST NAME</p>
                    <input class="input" id="firstName" name="FirstName" placeholder="FirstName">
                </div>
                <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                    <p class="text-blk input-title">LAST NAME</p>
                    <input class="input" id="lastName" name="LastName" placeholder="LastName">
                </div>
                <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                    <p class="text-blk input-title">EMAIL</p>
                    <input class="input" id="email" name="Email" placeholder="Email" >
                </div>
                <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                    <p class="text-blk input-title">PHONE NUMBER</p>
                    <input class="input" id="phoneNumber" name="PhoneNumber" placeholder="PhoneNumber" >
                </div>
                <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12" id="i634i-6">
                    <p class="text-blk input-title">WHAT DO YOU HAVE IN MIND</p>
                    <textarea class="textinput" id="enquiry" placeholder="Enquiry"></textarea>
                </div>
            </div>
            <div class="btn-wrapper">
                <button class="submit-btn" id="submitForm">Submit</button>
            </div>
        </div>
    </form>

      </div>
      <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-5 wk-ipadp-10" id="ifgi">
        <div class="container-box">
          <div class="text-content">
            <p class="text-blk contactus-head">
              Contact us
            </p>
            <p class="text-blk contactus-subhead">
             Should you have any concern or clarifications, feel free to email us and we will get in touch with you.
            </p>
          </div>
          <div class="workik-contact-bigbox">
            <div class="workik-contact-box">
              
              <div class="address text-box">
                <img class="contact-svg" src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/ET22.jpg">
                <p class="contact-text">
                  info@spcpta.lk
                </p>
              </div>
              <div class="mail text-box">
                <img class="contact-svg" src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/ET23.jpg">
                <p class="contact-text">
                  St.Peter's College Parents Teacher Association ,Galle Road ,Colombo 04
                </p>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>

<script>
  // Initialize Email.js with your user ID
emailjs.init("5DwuhHkRnFoagEBot");

// Attach the click event to the submit button
$(".submit-btn").on("click", function (e) {
  e.preventDefault();

  // Get values from the form
  var FirstName = $(".input[placeholder='FirstName']").val();
  var LastName = $(".input[placeholder='LastName']").val();
  var Email = $(".input[placeholder='Email']").val();
  var PhoneNumber = $(".input[placeholder='PhoneNumber']").val();
  var Enquiry = $(".textinput").val();

  // Your Email.js template ID and parameters
  var templateParams = {
    firstName: FirstName,
    lastName: LastName,
    email: Email,
    phoneNumber: PhoneNumber,
    enquiry: Enquiry,
  };

  // Send email using Email.js
  emailjs.send("service_pjk4h4n", "template_72qent9", templateParams).then(
    function (response) {
      // Email sent successfully, trigger success popup
      Swal.fire({
        title: "Success",
        text: "Your message has been sent successfully!",
        icon: "success",
        confirmButtonColor: "#d46a00",
      }).then(() => {
        // Reset form after successful submission
        $("#contactForm")[0].reset();
      });
    },
    function (error) {
      // Handle error if email sending fails
      Swal.fire({
        title: "Error",
        text: "Failed to send email. Please try again later.",
        icon: "error",
        confirmButtonColor: "#d46a00",
      });
      console.error("Failed to send email", error);
    }
  );
});

</script>

<?php include 'footer.php' ?>

<!-- SB Forms JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://smtpjs.com/v3/smtp.js"></script>


</body>
</html>