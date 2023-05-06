
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Feedback Form</title>

    <!-- Styles -->

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css"
    />

    <link rel="stylesheet" href="./static/css/bootstrap.css" />
    <link rel="stylesheet" href="./static/css/style.css" />
  </head>
  <body>
    <div class="text-center">
      <a
        href="#"
        class="btn btn-lg btn-primary"
        data-toggle="modal"
        data-target="#largeModal"
        >Click to open Modal</a
      >
    </div>
    <!-- large modal -->
    <div
      class="modal fade"
      id="largeModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="basicModal"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg feedback-modal">
        <div class="modal-content">
          <div class="modal-body">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>

            <div class="feedback-logo">
              <img src="./static/images/jm-main-logo.svg" />
            </div>
            <div class="feedback-form">
              <form>
                <!-- First Slide -->
                <label id="first" class="is-visible">
                  <img
                    class="newpaper-img img-fluid"
                    src="./static/images/icons/newspaper.png"
                  />
                  <label class="label-heading" for="first"
                    >What do you think of our monthly newsletter?</label
                  >
                  <p class="label-subheading">
                    Give us your feedback and help us improve
                  </p>
                  <input
                    name="first"
                    type="text"
                    value="first"
                    placeholder="name"
                    required
                  />
                  <div class="nav-btn-div">
                    <div class="nav-first-div">
                      <button
                        type="button"
                        class="nav-button"
                        value="next"
                        onclick="emptynext('first','second')"
                      >
                        Start
                        <!-- <i class="fa fa-check" aria-hidden="true"></i> -->
                      </button>
                    </div>
                    <div class="nav-second-div">
                      <p>
                        Press Enter
                        <img
                          class="img-fluid"
                          src="./static/images/enter.png"
                        />
                      </p>
                    </div>
                  </div>

                  <div class="arrow-div">
                    <i
                      class="fa fa-angle-right"
                      onclick="next('first','second')"
                    ></i>
                  </div>
                </label>
                <!-- End First Slide -->

                <!-- Start Second Slide -->
                <label id="second">
                  <img
                    class="newpaper-img img-fluid"
                    src="./static/images/icons/rating.png"
                  />
                  <label class="label-heading" for="second"
                    >1. How would you rate our newsletter overall?</label
                  >
                  <input
                    name="name"
                    type="hidden"
                    placeholder="name"
                    required
                  />
                  <div id="wrapper" class="rating-stars">
                    <input
                      type="radio"
                      id="star1"
                      name="star"
                      checked="checked"
                    />

                    <label for="star1"><strong>1</strong></label>

                    <input type="radio" id="star2" name="star" />
                    <label for="star2"><strong>2</strong></label>
                    <input type="radio" id="star3" name="star" />
                    <label for="star3"><strong>3</strong></label>
                    <input type="radio" id="star4" name="star" />
                    <label for="star4"><strong>4</strong></label>
                    <input type="radio" id="star5" name="star" />
                    <label for="star5"><strong>5</strong></label>
                  </div>
                  <div class="nav-btn-div">
                    <div class="nav-first-div">
                      <button
                        type="button"
                        class="nav-button nav-button1"
                        value="next"
                        onclick="emptynext('second','third')"
                      >
                        OK
                        <!-- <i class="fa fa-check" aria-hidden="true"></i> -->
                      </button>
                    </div>
                    <div class="nav-second-div">
                      <p>
                        Press Enter
                        <img
                          class="img-fluid"
                          src="./static/images/enter.png"
                        />
                      </p>
                    </div>
                  </div>
                  <!-- ↵ -->
                  <div class="arrow-div">
                    <i
                      class="fa fa-angle-left"
                      onclick="previous('third','second')"
                    ></i>
                    <i
                      class="fa fa-angle-right"
                      onclick="next('second','third')"
                    ></i>
                  </div>
                </label>
                <!-- End Second Slide -->
                <!-- Start Third Slide -->
                <label id="third">
                  <img
                    class="newpaper-img img-fluid"
                    src="./static/images/icons/write.png"
                  />
                  <label class="label-heading" for="third"
                    >2. How valuable is the content of the newsltter?</label
                  >
                  <input
                    type="hidden"
                    name="email"
                    placeholder="email"
                    required
                  />

                  <div class="rating_scale">
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>1</strong>
                    </label>

                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>2</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>3</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>4</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>5</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>6</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>7</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>8</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>9</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>10</strong>
                    </label>
                    <div class="third-slide-text">
                      <p class="third-slide-text1">NOT at all</p>
                      <p class="third-slide-text2">Very valuable</p>
                    </div>
                  </div>
                  <div class="nav-btn-div">
                    <div class="nav-first-div">
                      <button
                        type="button"
                        class="nav-button nav-button1"
                        value="next"
                        onclick="emptynext('third','fourth')"
                      >
                        OK
                      </button>
                    </div>
                    <div class="nav-second-div">
                      <p>
                        Press Enter
                        <img
                          class="img-fluid"
                          src="./static/images/enter.png"
                        />
                      </p>
                    </div>
                  </div>
                  <div class="arrow-div">
                    <i
                      class="fa fa-angle-left"
                      onclick="previous('third','second')"
                    ></i>
                    <i
                      class="fa fa-angle-right"
                      onclick="next('third','fourth')"
                    ></i>
                  </div>
                </label>
                <!-- End Third Slide -->
                <!-- fourth Slide -->
                <label id="fourth">
                  <img
                    class="newpaper-img img-fluid"
                    src="./static/images/icons/reviews.png"
                  />
                  <label class="label-heading" for="fourth"
                    >3. How would you rate the design?</label
                  >
                  <div class="rating_scale">
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>1</strong>
                    </label>

                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>2</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>3</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>4</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>5</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>6</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>7</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>8</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>9</strong>
                    </label>
                    <label>
                      <input type="radio" name="rad" /><span> </span>
                      <strong>10</strong>
                    </label>
                    <div class="third-slide-text">
                      <p class="third-slide-text1">Poor</p>
                      <p class="third-slide-text2">Excellent</p>
                    </div>
                  </div>
                  <input
                    name="second"
                    type="hidden"
                    value="start"
                    placeholder="name"
                    required
                  />
                  <div class="nav-btn-div">
                    <div class="nav-first-div">
                      <button
                        type="button"
                        class="nav-button nav-button1"
                        value="next"
                        onclick="emptynext('fourth','fifth')"
                      >
                        OK
                        <!-- <i class="fa fa-check" aria-hidden="true"></i> -->
                      </button>
                    </div>
                    <div class="nav-second-div">
                      <p>
                        Press Enter
                        <img
                          class="img-fluid"
                          src="./static/images/enter.png"
                        />
                      </p>
                    </div>
                  </div>

                  <div class="arrow-div">
                    <i
                      class="fa fa-angle-left"
                      onclick="previous('third','fourth')"
                    ></i>
                    <i
                      class="fa fa-angle-right"
                      onclick="next('fourth','fifth')"
                    ></i>
                  </div>
                </label>
                <!-- End fourth Slide -->
                <!-- Start fifth Slide -->
                <label id="fifth">
                  <img
                    class="newpaper-img img-fluid"
                    src="./static/images/icons/chat.png"
                  />
                  <label class="label-heading" for="fifth"
                    >4. Are you happy with the frequency of the
                    newsletter?</label
                  >
                  <input
                    type="hidden"
                    name="phone"
                    placeholder="phone"
                    required
                  />

                  <div class="radio-buttons-yesno">
                    <div class="">
                      <input type="radio" id="yes" name="radio" />

                      <label for="yes"
                        ><strong>Y</strong><span>Yes</span></label
                      >
                    </div>
                    <div>
                      <input type="radio" id="no" name="radio" />
                      <label for="no"><strong>N</strong><span>No</span></label>
                    </div>
                  </div>

                  <div class="nav-btn-div">
                    <div class="nav-first-div">
                      <button
                        type="button"
                        class="nav-button nav-button1"
                        value="next"
                        onclick="emptynext('fifth','sixth')"
                      >
                        OK
                        <!-- <i class="fa fa-check" aria-hidden="true"></i> -->
                      </button>
                    </div>
                    <div class="nav-second-div">
                      <p>
                        Press Enter
                        <img
                          class="img-fluid"
                          src="./static/images/enter.png"
                        />
                      </p>
                    </div>
                  </div>
                  <div class="arrow-div">
                    <i
                      class="fa fa-angle-left"
                      onclick="previous('fourth', 'fifth')"
                    ></i>
                    <i
                      class="fa fa-angle-right"
                      onclick="next('fifth','sixth')"
                    ></i>
                  </div>
                </label>
                <!-- End fifth Slide -->
                <!-- Start sixth Slide -->
                <label id="sixth">
                  <img
                    class="newpaper-img img-fluid"
                    src="./static/images/icons/feedback.png"
                  />
                  <label class="label-heading" for="sixth"
                    >5.Any other feedback you'd like to share?</label
                  >
                  <textarea
                    class="autoExpand"
                    rows="2"
                    data-min-rows="2"
                    autofocus
                  ></textarea>
                  <p class="textarea-subheading">Type your answer here...</p>

                  <div class="nav-btn-div">
                    <div class="nav-first-div">
                      <button
                        type="button"
                        class="nav-button nav-button2"
                        value="next"
                        onclick="emptynext('sixth','seventh')"
                      >
                        Submit
                        <!-- <i class="fa fa-check" aria-hidden="true"></i> -->
                      </button>
                    </div>
                    <div class="nav-second-div">
                      <p>
                        Press Enter
                        <img
                          class="img-fluid"
                          src="./static/images/enter.png"
                        />
                      </p>
                    </div>
                  </div>
                  <div class="arrow-div">
                    <i
                      class="fa fa-angle-left"
                      onclick="previous('fifth', 'sixth')"
                    ></i>
                    <i
                      class="fa fa-angle-right"
                      onclick="next('sixth','seventh')"
                    ></i>
                  </div>
                </label>
                <!-- End sixth Slide -->
                <!-- Start seventh Slide -->
                <label id="seventh" class="contact-details">
                  <img
                    class="newpaper-img img-fluid"
                    src="./static/images/icons/social-networks.png"
                  />
                  <label class="label-heading" for="seventh"
                    >We appreciate your feedback!</label
                  >
                  <div class="contact-details-in">
                    <label for="name">Name</label>
                    <input name="name" type="text" placeholder="" />
                  </div>
                  <div class="contact-details-in">
                    <label for="email">Email</label>
                    <input name="email" type="email" placeholder="" />
                  </div>
                  <div class="contact-details-in">
                    <label for="phone">Mobile</label>
                    <input name="phone" type="tel" placeholder="" />
                  </div>
                  <p class="social-links-text">Social Media Links</p>
                  <div class="nav-btn-div">
                    <div class="nav-first-div">
                      <button
                        type="button"
                        class="nav-button nav-button3"
                        value="next"
                        onclick="emptynext('seventh','eighth')"
                      >
                        Again
                        <!-- <i class="fa fa-check" aria-hidden="true"></i> -->
                      </button>
                    </div>
                    <div class="nav-second-div">
                      <p>
                        Press Enter
                        <img
                          class="img-fluid"
                          src="./static/images/enter.png"
                        />
                      </p>
                    </div>
                  </div>
                  <div class="arrow-div">
                    <i
                      class="fa fa-angle-left"
                      onclick="previous('sixth', 'seventh')"
                    ></i>
                    <i
                      class="fa fa-angle-right"
                      onclick="next('seventh','eighth')"
                    ></i>
                  </div>
                  <div class="social-media-links">
                    <p>
                      <a href="#"
                        ><i class="fa fa-facebook" aria-hidden="true"></i
                      ></a>
                    </p>
                    <p>
                      <a href="#"
                        ><i class="fa fa-instagram" aria-hidden="true"></i
                      ></a>
                    </p>
                    <p>
                      <a href="#"
                        ><i class="fa fa-twitter" aria-hidden="true"></i
                      ></a>
                    </p>
                    <p>
                      <a href="#"
                        ><i class="fa fa-youtube-play" aria-hidden="true"></i
                      ></a>
                    </p>
                  </div>
                </label>
                <!-- End seventh Slide -->
                <!-- Start eighth Slide -->
                <label id="eighth">
                  <img
                    class="newpaper-img img-fluid"
                    src="./static/images/icons/email (1).png"
                  />
                  <label class="label-heading thankyou-heading" for="eighth"
                    >Thank you</label
                  >
                  <p>Thank You For Your valuable feedback.</p>
                  <div class="arrow-div">
                    <i
                      class="fa fa-angle-left"
                      onclick="previous('seventh','eighth')"
                    ></i>
                  </div>
                </label>
                <!-- End eighth Slide -->

                <p id="validate"></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./static/js/bootstrap.bundle.js"></script>
    <script>
      const stars = document.querySelectorAll(".rating-stars input");
      stars.forEach((star) => {
        console.log(star);
      });
      let error = document.getElementById("validate");
      let label = document.getElementsByTagName("label");

      document.getElementById("first").addEventListener("keyup", function (e) {
        if (e.keyCode === 13) {
          e.preventDefault();
          emptynext("first", "second");
        }
      });

      document.getElementById("second").addEventListener("keyup", function (e) {
        if (e.keyCode === 13) {
          e.preventDefault();
          next("second", "third");
        }
      });

      document.getElementById("third").addEventListener("keyup", function (e) {
        if (e.keyCode === 13) {
          e.preventDefault();
          next("third", "fourth");
        }
      });
      document.getElementById("fourth").addEventListener("keyup", function (e) {
        if (e.keyCode === 13) {
          e.preventDefault();
          emptynext("fourth", "fifth");
        }
      });
      document.getElementById("fifth").addEventListener("keyup", function (e) {
        if (e.keyCode === 13) {
          e.preventDefault();
          next("fifth", "sixth");
        }
      });

      document.getElementById("sixth").addEventListener("keyup", function (e) {
        if (e.keyCode === 13) {
          e.preventDefault();
          next("sixth", "seventh");
        }
      });
      document
        .getElementById("seventh")
        .addEventListener("keyup", function (e) {
          if (e.keyCode === 13) {
            e.preventDefault();
            next("seventh", "eighth");
          }
        });

      function next(from, to) {
        error.innerHTML = "";
        let value = document.getElementById(from).children[1].value;
        if (!value || value === "") {
          error.innerHTML = "Please enter a value";
        } else {
          error.innerHTML = "";
          document.getElementById(from).classList.remove("is-visible");
          document.getElementById(to).classList.add("is-visible");
        }
      }
      function emptynext(from, to) {
        error.innerHTML = "";
        let value = document.getElementById(from).children[1].value;
        document.getElementById(from).classList.remove("is-visible");
        document.getElementById(to).classList.add("is-visible");
      }

      function previous(from, to) {
        error.innerHTML = "";
        document.getElementById(from).classList.remove("is-visible");
        document.getElementById(to).classList.add("is-visible");
      }
    </script>
  </body>
</html>
