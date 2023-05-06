<style>
    .container {
      /* width: 100%; */
      /* height: 100%; */
    }
    .checkmark__circle {
      stroke-dasharray: 166;
      stroke-dashoffset: 166;
      stroke-width: 5;
      stroke-miterlimit: 10;
      stroke: rgba(7, 134, 219, 0.781);
      fill: none;
      /* box-shadow: 0px 0px 5px rgb(4, 122, 201); */
      animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    .checkmark {
      width: 66px;
      height: 66px;
      border-radius: 50%;
      display: block;
      stroke-width: 5;
      stroke: rgb(7, 134, 219);
      stroke-miterlimit: 10;
      margin: 1% auto;
      box-shadow: inset 0px 0px 0px rgb(4, 122, 201);
      animation: fill 0.4s ease-in-out 0.4s forwards,
        scale 0.3s ease-in-out 0.9s both;
    }

    .checkmark__check {
      transform-origin: 50% 50%;
      stroke-dasharray: 48;
      stroke-dashoffset: 48;
      animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }

    @keyframes stroke {
      100% {
        stroke-dashoffset: 0;
      }
    }
    @keyframes scale {
      0%,
      100% {
        transform: none;
      }
      50% {
        transform: scale3d(1.1, 1.1, 1);
      }
    }
    @keyframes fill {
      100% {
        box-shadow: inset 0px 0px 0px 30px #fff;
      }
    }

    .thank-you {
      /* display: inline-block; */
      /* padding: 20px; */
      background: white;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 5px rgb(219, 219, 219);
      width: 650px;
      margin: 20px auto;
      /* margin-top: 150px; */
      padding: 40px 0;
      /* margin: 50px; */
    }
    body {
      background: rgb(225, 244, 255);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .texts{
        text-align: center
    }
  </style>

<section>
    <div
      class="container thank-you d-flex flex-column justify-content-center align-items-center"
    >
      <svg
        class="checkmark"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 52 52"
      >
        <circle
          class="checkmark__circle"
          cx="26"
          cy="26"
          r="25"
          fill="none"
        />
        <path
          class="checkmark__check"
          fill="none"
          d="M14.1 27.2l7.1 7.2 16.7-16.8"
        />
      </svg>
<div class="d-flex flex-column texts">
        <h3>Password Reset Instruction</h3>
        <h3>Has Been Sent To</h3>
        <h3>Your Email Id.</h3>
    </div>
    </div>
  </section>