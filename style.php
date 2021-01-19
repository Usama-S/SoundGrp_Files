<style>

/* anchor-like button */
.btn-anchor {
  padding: 0;
  color: #4e73df;
}

.btn-anchor:hover {
  color: #254fcc;
  text-decoration: underline;
}
/* /anchor-like button */

/* login form shake animation */
.shakeit {
  /* Start the shake animation and make the animation last for 0.5 seconds */
  animation: shakeit 0.5s;

  /* When the animation is finished, start again */
  animation-iteration-count: 1;
}

@keyframes shakeit {
  0% { transform: translate(1px, 1px) rotate(0deg); }
  10% { transform: translate(-1px, -2px) rotate(-1deg); }
  20% { transform: translate(-3px, 0px) rotate(1deg); }
  30% { transform: translate(3px, 2px) rotate(0deg); }
  40% { transform: translate(1px, -1px) rotate(1deg); }
  50% { transform: translate(-1px, 2px) rotate(-1deg); }
  60% { transform: translate(-3px, 1px) rotate(0deg); }
  70% { transform: translate(3px, 1px) rotate(-1deg); }
  80% { transform: translate(-1px, -1px) rotate(1deg); }
  90% { transform: translate(1px, 2px) rotate(0deg); }
  100% { transform: translate(1px, -2px) rotate(-1deg); }
}
/* login form shake animation */

/* input feild sizing for sign up form */
.input-full {
  width: calc(100% - 20px) !important;
}

.input-half {
  width: calc(50% - 20px) !important;
}
/* /input feild sizing for sign up form */

</style>
