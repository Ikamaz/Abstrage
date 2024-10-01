<!DOCTYPE html>
<html lang="en">
  <head>
    @include('home.css')
  </head>
  <body>
    @include('home.header')

    <section class="contact">
        <h1>საკონტაქტო ინფორმაცია</h1>
        <div class="contact-details">
          <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1488.9380922845185!2d44.720560498178195!3d41.72319053783136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x404473002ea6670d%3A0x9d6b86a1e2d5a014!2sAbstrage!5e0!3m2!1sen!2sge!4v1723310179791!5m2!1sen!2sge" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
          <div class="contact-info">
            <p>
              <strong>ტელეფონი:</strong><a href="tel:+995574652211">+995 574 65 22 11</a>
            </p>
            <p>
              <strong>მეილი:</strong><a href="mailto:Abstrage@gmail.com"> Abstrage@gmail.com</a>
            </p>
            <p>
              <strong>სამუშაო საათები</strong>
            </p>
            <ul>
              <li>ორშაბათი - პარასკევი: 10:00 - 19:00</li>
              <li>შაბათი: 10:00 - 4:00 </li>
              <li>კვირა: დაკეტილია</li>
            </ul>
          </div>
        </div>
      </section>


    @include('home.footer')
    @include('home.js')
  </body>

</html>
