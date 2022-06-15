<?php include "top.php" ?>
<?php include "header.php" ?>
<script>
  function thanks() {

    document.getElementById("thanks").style.display = "";
  }
</script>
<section class="hero-barishal welcome_area" id="home">
  <div class="background-shapes">
    <div class="box1"></div>
    <div class="box2"></div>
    <div class="box3"></div>
    <div class="dot1"></div>
    <div class="dot2"></div>
    <div class="dot3"></div>
    <div class="dot4"></div>
    <div class="heart1"><i class="lni-heart"></i></div>
    <div class="heart2"><i class="i lni-heart"></i></div>
    <div class="circle1"></div>
    <div class="circle2"></div>
  </div>
  <div class="container h-100">
    <div class="row h-100 justify-content-between align-items-center">
      <div class="col-12 col-md-6">
        <div class="welcome_text_area">
          <h2 class="wow fadeInUp" data-wow-delay="0.2s"><?php _e("SocialJutsu™") ?></h2>
          <h3 class="wow fadeInUp" style="color: grey;" data-wow-delay="0.2s">Social Media Made Easy.</h3>
          <h5 class="wow fadeInUp" style="color: grey;" data-wow-delay="0.2s">Save time and energy by posting to all of your socials from one spot! Schedule your posts, view analytics, and let our AI Post Generator provide you with post ideas to engage and market to your audience!</h5>

          <a class="btn wimax-btn mt-30 wow fadeInUp" href="<?php _e(get_url("signup")) ?>" data-wow-delay="0.4s"><?php _e("Join the Beta!") ?></a><a class="btn wimax-btn btn-2 mt-30 ml-2 wow fadeInUp" href="#features" data-wow-delay="0.5s"><?php _e("Learn More") ?></a>

          <!-- <div class="register-form">
            <form action="<?php _e(get_module_url("ajax_email", $this)) ?>" class="actionLogin" method="post" data-redirect="<?php _e(post('redirect') ? post('redirect') : get_url('dashboard')) ?>">
              <div class="form-group">
                <input class="form-control" type="text" name="email" placeholder="<?php _e("Email") ?>">
              </div>
              <span class="show-message"></span>
              <button class="btn wimax-btn w-100" onClick="thanks()" type="submit">Join the waitlist!</button>
              <span style="display: none;" id="thanks">Thank you. You will receive an email when the site is live!</span>

            </form>
          </div> -->
        </div>
      </div>
      <div class="col-10 col-sm-8 col-md-5">
        <div class="welcome_area_thumb text-center wow fadeInUp" data-wow-delay="0.2s"><img src="<?php _e(get_theme_frontend_url('assets/img/bg-img/drakememe.jpg')) ?>" alt=""></div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="welcome-border"></div>
  </div>
</section>
<section class="about_area section_padding_130">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-lg-6">
        <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s">
          <h6><?php _e("Using Benefits") ?></h6>
          <h3><?php _e("A simple, smart & proven way to boost your work performance") ?></h3>
          <div class="line"></div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center align-items-center">
      <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="about_product_discription">
          <div class="row">
            <div class="col-12">
              <div class="single_about_part wow fadeInUp" data-wow-delay="0.2s">
                <div class="feature_icon"><i class="lni lni-download"></i></div>
                <h6><?php _e("No downloads") ?></h6>
                <p><?php _e("You can use our service straight from the web on all browsers. You don't need to download or install anything to enjoy our service") ?></p>
              </div>
            </div>
            <div class="col-12">
              <div class="single_about_part wow fadeInUp" data-wow-delay="0.3s">
                <div class="feature_icon"><i class="lni lni-timer"></i></div>
                <h6><?php _e("Saving Time") ?></h6>
                <p><?php _e("Dedicating just 10-20 minutes a day on your social media strategy can dramatically improve your customer relations and interactions") ?></p>
              </div>
            </div>
            <div class="col-12">
              <div class="single_about_part wow fadeInUp" data-wow-delay="0.4s">
                <div class="feature_icon"><i class="lni-layers"></i></div>
                <h6><?php _e("Schedule posts") ?></h6>
                <p><?php _e("Select your date, time or whenever you want to publish on each of your social accounts with just a few clicks") ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-8 col-lg-4">
        <div class="about_product_thumb text-center my-5 my-lg-0"><img src="<?php _e(get_theme_frontend_url('assets/img/bg-img/features-img.png')) ?>" alt=""></div>
      </div>
      <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="about_product_discription">
          <div class="row">
            <div class="col-12">
              <div class="single_about_part wow fadeInUp" data-wow-delay="0.2s">
                <div class="feature_icon"><i class="lni lni-pie-chart"></i></div>
                <h6><?php _e("Analytics performance") ?></h6>
                <p><?php _e("Our Twitter and Instagram Analytics feature helps you get a sense on what posts work and which posts don't") ?></p>
              </div>
            </div>
            <div class="col-12">
              <div class="single_about_part wow fadeInUp" data-wow-delay="0.3s">
                <div class="feature_icon"><i class="lni lni-network"></i></div>
                <h6><?php _e("Maximize Connections") ?></h6>
                <p><?php _e("Respond to Direct Messages for Twitter and Instagram and stay connected to your audience") ?></p>
              </div>
            </div>
            <div class="col-12">
              <div class="single_about_part wow fadeInUp" data-wow-delay="0.4s">
                <div class="feature_icon"><i class="lni lni-shield"></i></div>
                <h6><?php _e("Safe and Secure") ?></h6>
                <p><?php _e("Your data is safe with us. We're not one of those companies that gives your personal information away") ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="using_benefits_area section_padding_130" id="benefits">
  <div class="benefit-top-thumbnail"><img src="<?php _e(get_theme_frontend_url('assets/img/core-img/video-bottom.png')) ?>" alt=""></div>
  <div class="benefit-bottom-thumbnail"><img src="<?php _e(get_theme_frontend_url('assets/img/core-img/benefit-bottom.png')) ?>" alt=""></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-lg-6">
        <div class="section_heading white text-center wow fadeInUp" data-wow-delay="0.2s">
          <h3><?php _e("We're more than a scheduling tool. Explore our features, and beat the algorithm") ?></h3>
          <div class="line"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-sm-6 col-lg-4">
        <div class="single_benifits d-flex wow fadeInUp" data-wow-delay="200ms">
          <div class="icon_box"><i class="lni-heart"></i></div>
          <div class="benifits_text">
            <h5><?php _e("Visually plan and schedule your social media campaigns") ?></h5>
            <p><?php _e("Coordinate creative campaigns to drive engagement on social") ?>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-4">
        <div class="single_benifits d-flex wow fadeInUp" data-wow-delay="200ms">
          <div class="icon_box"><i class="lni-color-pallet"></i></div>
          <div class="benifits_text">
            <h5><?php _e("Measure and report on the performance of your content") ?></h5>
            <p><?php _e("Get in-depth insights to grow your reach, engagement, and sales") ?>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-4">
        <div class="single_benifits d-flex wow fadeInUp" data-wow-delay="200ms">
          <div class="icon_box"><i class="lni-grid-alt"></i></div>
          <div class="benifits_text">
            <h5><?php _e("Monitor engagement across all your social channels") ?></h5>
            <p><?php _e("Engage with your audience & build a community that loves your brand.") ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="about_app_area section_padding_130">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-12 col-md-6 col-lg-5">
        <div class="about_image mb-5 mb-md-0">
          <div class="big_thumb wow fadeInLeft" data-wow-delay="0.2s">
            <video width="100%" autoplay loop muted>
              <source src="<?php _e(get_theme_frontend_url('assets/aipostgenerator.mp4')) ?>" alt="ai post generator">
            </video>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-5">
        <div class="about_us_text_area wow fadeInUp" data-wow-delay="0.2s">
          <h3><?php _e("Save yourself time and headaches with our AI Post Generator!") ?></h3>
          <p><?php _e("Do you find yourself stuck trying to think of what to post to your socials? Not anymore. Our AI Post Generator will save you hours each day.") ?></p>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="border-top"></div>
</div>


<div class="features_section padding-b2" id="features">
  <div class="content_section">
    <div style="display: flex;
    flex-direction: column;" class="col centered grey-bg margin-t8">
      <h3 class="text-centered padding-s2">Features</h3>
      <div style="display: flex;
    flex-direction: row;
    flex-wrap: wrap;" class="row centered padding-s4">
        <div data-aos="zoom-in" class="staticcard aos-init aos-animate"><svg viewBox="0 0 24 24">
            <path fill="current" d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z"></path>
          </svg>
          <h4>Instant preview</h4>
          <p>Preview your posts instantly as you compose them</p>
        </div>
        <div data-aos="zoom-in" class="staticcard aos-init aos-animate"><svg viewBox="0 0 24 24">
            <path fill="current" d="M18.13 12L19.39 10.74C19.83 10.3 20.39 10.06 21 10V9L15 3H5C3.89 3 3 3.89 3 5V19C3 20.1 3.89 21 5 21H11V19.13L11.13 19H5V5H12V12H18.13M14 4.5L19.5 10H14V4.5M19.13 13.83L21.17 15.87L15.04 22H13V19.96L19.13 13.83M22.85 14.19L21.87 15.17L19.83 13.13L20.81 12.15C21 11.95 21.33 11.95 21.53 12.15L22.85 13.47C23.05 13.67 23.05 14 22.85 14.19Z"></path>
          </svg>
          <h4>One composer</h4>
          <p>Compose and schedule your posts for Facebook, Twitter, Instagram, LinkedIn, GGs, and Reddit ALL from the same composer.</p>
        </div>

        <div data-aos="zoom-in" class="staticcard aos-init aos-animate"><svg viewBox="0 0 24 24">
            <path fill="current" d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"></path>
          </svg>
          <h4>Twitter Auto-Threading</h4>
          <p>Automatically transform your text into a Twitter thread if larger than 280 characters</p>
        </div>

        <div data-aos="zoom-in" class="staticcard aos-init aos-animate"><svg viewBox="0 0 24 24">
            <path fill="current" d="M3,5A2,2 0 0,1 5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5M7,18H9L9.35,16H13.35L13,18H15L15.35,16H17.35L17.71,14H15.71L16.41,10H18.41L18.76,8H16.76L17.12,6H15.12L14.76,8H10.76L11.12,6H9.12L8.76,8H6.76L6.41,10H8.41L7.71,14H5.71L5.35,16H7.35L7,18M10.41,10H14.41L13.71,14H9.71L10.41,10Z"></path>
          </svg>
          <h4>Hashtags Generator</h4>
          <p>Our AI can automatically find the best hashtags for your post</p>
        </div>
        <div data-aos="zoom-in" class="staticcard aos-init"><svg viewBox="0 0 24 24">
            <path fill="current" d="M16,11.78L20.24,4.45L21.97,5.45L16.74,14.5L10.23,10.75L5.46,19H22V21H2V3H4V17.54L9.5,8L16,11.78Z"></path>
          </svg>
          <h4>Analytics</h4>
          <p>Measure the performance of your posts on Twitter and Instagram</p>
        </div>

        <div data-aos="zoom-in" class="staticcard aos-init"><svg viewBox="0 0 24 24">
            <path fill="current" d="M5 3A2 2 0 0 0 3 5H5M7 3V5H9V3M11 3V5H13V3M15 3V5H17V3M19 3V5H21A2 2 0 0 0 19 3M3 7V9H5V7M7 7V11H11V7M13 7V11H17V7M19 7V9H21V7M3 11V13H5V11M19 11V13H21V11M7 13V17H11V13M13 13V17H17V13M3 15V17H5V15M19 15V17H21V15M3 19A2 2 0 0 0 5 21V19M7 19V21H9V19M11 19V21H13V19M15 19V21H17V19M19 19V21A2 2 0 0 0 21 19Z"></path>
          </svg>
          <h4>Social Groups</h4>
          <p>Gather social accounts into groups for better management</p>
        </div>
        <div data-aos="zoom-in" class="staticcard aos-init"><svg viewBox="0 0 24 24">
            <path fill="current" d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z"></path>
          </svg>
          <h4>Team</h4>
          <p>Split the workload by inviting your team</p>
        </div>
        <div data-aos="zoom-in" class="staticcard aos-init"><svg viewBox="0 0 24 24">
            <path fill="current" d="M9,10V12H7V10H9M13,10V12H11V10H13M17,10V12H15V10H17M19,3A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5A2,2 0 0,1 5,3H6V1H8V3H16V1H18V3H19M19,19V8H5V19H19M9,14V16H7V14H9M13,14V16H11V14H13M17,14V16H15V14H17Z"></path>
          </svg>
          <h4>Monthly Calendar</h4>
          <p>Visualise your social posting calendar per month</p>
        </div>
        <div data-aos="zoom-in" class="staticcard aos-init"><svg viewBox="0 0 24 24">
            <path fill="current" d="M6 1H8V3H16V1H18V3H19C20.11 3 21 3.9 21 5V19C21 20.11 20.11 21 19 21H5C3.89 21 3 20.1 3 19V5C3 3.89 3.89 3 5 3H6V1M5 8V19H19V8H5M7 10H17V12H7V10Z"></path>
          </svg>
          <h4>Unlimited Scheduling</h4>
          <p>Yes, even the free tier!</p>
        </div>
      </div>
    </div>
  </div>
</div>



<section class="work_process_area section_padding_130_80">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-lg-6">
        <div class="section_heading text-center">
          <h3><?php _e("Extra Performance") ?></span></h3>
          <p><?php _e("Some extra core features available") ?></p>
          <div class="line"></div>
        </div>
      </div>
    </div>
    <div class="row justify-content-between">
      <div class="col-12 col-sm-4 col-md-3">
        <div class="single_work_step">
          <div class="step-icon"><i class="lni lni-image"></i></div>
          <h5><?php _e("Built-in Editor") ?></h5>
          <p><?php _e("Easily edit your images with a super simple interface") ?></p>
        </div>
      </div>
      <div class="col-12 col-sm-4 col-md-3">
        <div class="single_work_step">
          <div class="step-icon"><i class="lni lni-folder"></i></div>
          <h5><?php _e("File manager") ?></h5>
          <p><?php _e("Fully integrated with the best image uploading and editing currently available") ?></p>
        </div>
      </div>
      <div class="col-12 col-sm-4 col-md-3">
        <div class="single_work_step">
          <div class="step-icon"><i class="lni lni-code-alt"></i></div>
          <h5><?php _e("AI Powered Ideas") ?></h5>
          <p><?php _e("Let our AI Post Idea Generator give you content") ?></p>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="border-top"></div>
</div>
<section class="testimonial_area section_padding_130" id="rating">
  <div class="testimonial-top-thumbnail"><img src="<?php _e(get_theme_frontend_url('assets/img/core-img/testimonial-top.png')) ?>" alt=""></div>
  <div class="testimonial-bottom-thumbnail"><img src="<?php _e(get_theme_frontend_url('assets/img/core-img/testimonial-bottom.png')) ?>" alt=""></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-lg-6">
        <div class="section_heading white text-center">
          <h3><?php _e("Our Happy Users!") ?></h3>
          <p><?php _e("Our users praise us for our easy to use website, support, and innovative features! Here are what just a few of them had to say") ?></p>
          <div class="line"></div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-10 col-md-9 col-lg-7">
        <div class="card border-0 p-4 p-sm-5 testimonials owl-carousel">
          <div class="single_testimonial_area text-center">
            <div class="testimonial_author_thumb"><img src="<?php _e(get_theme_frontend_url('assets/img/advisor-img/warchief.jpg')) ?>" alt=""></div>
            <div class="testimonial_text">
              <p><?php _e("Just saying if you dont have an account on SJ, YOU NEED ONE! This will not only help you promote your content, but it will save you TONS of time! Post to all your social media in the time it takes to make one post! Type, Click, Done!") ?></p>
              <div class="rating"><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i></div>
              <div class="testimonial_author_name">
                <a href="https://twitter.com/warchiefog">
                  <h5><?php _e("WarchiefOG") ?></h5>
                </a>
                <h6><?php _e("Twitch Streamer") ?></h6>
              </div>
            </div>
          </div>
          <div class="single_testimonial_area text-center">
            <div class="testimonial_author_thumb"><img src="<?php _e(get_theme_frontend_url('assets/img/advisor-img/mackman.jpg')) ?>" alt=""></div>
            <div class="testimonial_text">
              <p><?php _e("SocialJutsu is the simplest, most powerful, and easiest to use website when it comes to posting to all my favorite social media accounts!!") ?></p>
              <div class="rating"><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i></div>
              <div class="testimonial_author_name">
                <a href="https://twitter.com/mackmangg">
                  <h5><?php _e("Mackman Gaming") ?></h5>
                </a>
                <h6><?php _e("Youtube Content Creator") ?></h6>
              </div>
            </div>
          </div>
          <div class="single_testimonial_area text-center">
            <div class="testimonial_author_thumb"><img src="<?php _e(get_theme_frontend_url('assets/img/advisor-img/john.jpg')) ?>" alt=""></div>
            <div class="testimonial_text">
              <p><?php _e("Being able to post to all of our socials, especially our own site, saves us time, money, and allows us to focus on what really matters: building our community!") ?></p>
              <div class="rating"><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i><i class="lni-star-filled"></i></div>
              <div class="testimonial_author_name">
                <a href="https://twitter.com/johnreaveslive">
                  <h5><?php _e("John Reaves") ?></h5>
                </a>
                <h6><?php _e("CEO & Co-Owner, GGs.tv") ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</section>
<?php if (!empty($faqs)) { ?>
  <div class="faq_area section_padding_130" id="faq">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-lg-6">
          <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s">
            <h3><?php _e("Frequently Asked Questions") ?></h3>
            <p><?php _e("We've crafted this FAQ page to answer many of your frequently asked questions") ?></p>
            <div class="line"></div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-lg-8">
          <div class="accordion faq-accordian" id="faqAccordion">

            <?php foreach ($faqs as $key => $faq) : ?>
              <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s">
                <div class="card-header" id="heading<?php _e($key) ?>">
                  <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse<?php _e($key) ?>" aria-expanded="true" aria-controls="collapse<?php _e($key) ?>"><?php _e($faq->name) ?><span class="lni-chevron-up"></span></h6>
                </div>
                <div class="collapse" id="collapse<?php _e($key) ?>" aria-labelledby="headingOne" data-parent="#faqAccordion">
                  <div class="card-body">
                    <?php _e(htmlspecialchars_decode($faq->content, ENT_QUOTES), false) ?>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<div class="download_app_area section_padding_130_80" id="download">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section_heading white text-center">
          <h3><?php _e("Start your free trial. Are you ready to try SocialJutsu? No contract. No credit card") ?></h3>
          <div class="line bg-white"></div>
          <a class="btn wimax-btn mt-30 wow fadeInUp" href="<?php _e(get_url("signup")) ?>"><?php _e("Join the Beta!") ?></a>
        </div>

      </div>
    </div>
  </div>
</div>
<?php include "footer.php" ?>
<?php include "bottom.php" ?>