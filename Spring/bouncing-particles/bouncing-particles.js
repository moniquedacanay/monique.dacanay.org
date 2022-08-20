/* This program simulates particles moving about in a confined space.

   Author:
     Aaron Weeden, 2015
     Monique Dacanay, 2018
 */

// Define model parameters
var N_P             = 100;           // the total number of particles
var P_WIDTH         = 20;          // width of a particle in pixels
var P_HEIGHT        = 30;          // height of a particle in pixels
var IS_BOUNCING     = false;       // should particles bounce off each other?
var COLOR           = "turquoise";      // the default CSS color of a particle
var COLOR2          = "green";      // the default CSS color of one special particle
var SHAPE           = "arc";      // the default shape of a particle, can be
                                   // "rect" or "arc"
var MILLIS_PER_STEP = 1;          // the number of milliseconds in between time
                                   // steps
var CAN_WIDTH       = 600;         // width of HTML canvas element
var CAN_HEIGHT      = 300;         // height of HTML canvas element
var ARC_START_ANGLE = 0;           // starting angle for drawing arcs
var ARC_END_ANGLE   = 2 * Math.PI; // ending angle for drawing arcs
var Particles       = [];          // an array to store the particle objects
var Canvas;                        // HTML canvas object (defined later)
var Context;                       // HTML canvas context object (defined later)

// Define the function that occurs when the HTML document loads
onload = function () {
  // Initialize the canvas and particles by calling functions
  getCanvasAndContext();
  setCanvasSize();
  createParticles();
  // Call the step function repeatedly, once per MILLIS_PER_STEP milliseconds
  setInterval(step, MILLIS_PER_STEP);
  // Finish defining the function that occurs when the HTML document loads
}

// Define a function to store the objects for the HTML canvas and its context
function getCanvasAndContext() {
  Canvas = document.getElementById("canvas");
  Context = Canvas.getContext("2d");
  // Finish defining a function to store the objects for the HTML canvas and
  // its context
}

// Define a function for setting the width and height of the canvas
function setCanvasSize() {
  Canvas.width  = CAN_WIDTH;
  Canvas.height = CAN_HEIGHT;
  // Finish defining a function for setting the width and height of the canvas
}

// Define a function for creating particles
function createParticles() {
  // Loop for each particle
  for (var i = 0; i < N_P; i++) {
    // Call the function to create a new particle
    createParticle();
    // Finish looping for each particle
  }
  // Set the color of the special particle
  Particles[0].color = COLOR2;
  // Finish defining a function for creating particles
}

// Define a function to create a new particle
function createParticle() {
  // Create a new object for the particle
  var newParticle = {};
  // Create a random x location for the particle -- the maximum x it can be
  // is one particle-width away from the right side of the canvas
  newParticle.x = getRandomInt(CAN_WIDTH - P_WIDTH);
  // Create a random y location for the particle -- the maximum y it can be
  // is one particle-height away from the bottom side of the canvas
  newParticle.y = getRandomInt(CAN_HEIGHT - P_HEIGHT);
  // Give the particle a color
  newParticle.color = COLOR;
  // Give the particle a shape
  newParticle.shape = SHAPE;
  // Flip a coin. If heads, set the particle moving left. If tails, set the
  // particle moving right. Flip another coin for up/down.
  newParticle.dx = flipCoin() ? -1 : 1;
  newParticle.dy = flipCoin() ? -1 : 1;
  // Add the particle object to the array of particles
  Particles.push(newParticle);
  // Finish defining a function to create a new particle
}

// Define a function to get a random integer
function getRandomInt(max) {
  // Get a random number between 0 (inclusive) and 1 (exclusive)
  var r = Math.random();
  // Change the number to be between 0 (inclusive) and max (exclusive)
  r *= max;
  // Make the number an integer by removing whatever is after the decimal place
  r = Math.floor(r);
  // Return the number as the output of this function
  return r;
  // Finish defining a function to get a random integer
}

// Define a function which randomly returns either true or false
function flipCoin() {
  // Call a function to get a random integer less than 2 (i.e. 0 or 1)
  var val = getRandomInt(2);
  // Return true if the value equals 0 and false otherwise
  return val === 0;
  // Finish defining a function which randomly returns either true or false
}

// Define a function to advance the model by one step
function step() {
  // Call a function to clear the canvas
  clearCanvas();
  // Loop over all particles.
  for (var i = 0; i < Particles.length; i++) {
    // Call a function to draw the particle, passing in the particle
    drawParticle(Particles[i]);
    // Loop over all other particles that have not yet been looped over
    for (var j = i + 1; j < Particles.length; j++) {
      // Call a function to see if the two particles should bounce off each
      // other, passing in the two particles
      checkBounce(Particles[i], Particles[j]);
      // Finish looping over all other particles that have not yet been looped
      // over
    }
    // Call a function to see if the particle should bounce off a wall
    checkWallBounce(Particles[i]);
    // Move the particle to its new position
    Particles[i].x += Particles[i].dx;
    Particles[i].y += Particles[i].dy;
  }
}

// Define a function to clear the canvas
function clearCanvas() {
  // Set the canvas color for filling in shapes to be white
  Context.fillStyle = "white";
  // Fill in a rectangle from the top-left corner to the bottom-right corner
  Context.fillRect(0, 0, Canvas.width, Canvas.height);
  // Finish defining a function to clear the canvas
}

// Define a function to draw a given particle
function drawParticle(particle) {
  // Set the canvas' color for filling in shapes to be the particle's color
  Context.fillStyle = particle.color;
  // Do different code depending on the particle's shape
  switch (particle.shape) {
    // If the shape is a rectangle
    case "rect":
      // Call a function to draw a rectangle, passing in the particle
      drawRect(particle);
      // Finish with the case in which the shape is a rectangle
      break;
    // If the shape is an arc
    case "arc":
      // Call a function to draw an arc, passing in the particle
      drawArc(particle);
      // Finish with the case in which the shape is an arc
      break;
    // Finish doing different code depending on the particle's shape
  }
  // Finish defining a function to draw a given particle
}

// Define a function to draw a rectangle, given a particle
function drawRect(particle) {
  // Call a function to tell the canvas to fill in a rectangle
  Context.fillRect(particle.x, // left x-coordinate
    particle.y, // top y-coordinate
    P_WIDTH, // width
    P_HEIGHT); // height
  // Finish defining a function to draw a rectangle, given a particle
}

// Defining a function to draw an arc, given a particle
function drawArc(particle) {
  // Call a function to tell the canvas to start drawing
  Context.beginPath();
  // Call a function to tell the canvas to draw an arc
  Context.arc(particle.x + 0.5 * P_WIDTH, // center x-coordinate
    particle.y + 0.5 * P_WIDTH, // center y-coordinate
    0.5 * P_WIDTH, // radius
    ARC_START_ANGLE, // starting angle
    ARC_END_ANGLE); // ending angle
  // Call a function to tell the canvas to fill in the shape it just drew
  Context.fill();
  // Finish defining a function to draw an arc, given a particle
}

// Define a function to see if the two particles should bounce off each
// other, given the two particles
function checkBounce(p1, p2) {
  // If the variable for bouncing is false, exit this function early
  if (!IS_BOUNCING) {
    return;
  }
  // Call a function to check if the two particles are intersecting
  if (isIntersecting(p1, p2)) {
    // Set the new direction of the first particle
    p1.dx = (p1.x < p2.x)  ? -1 : 1;
    p1.dy = (p1.y < p2.y)  ? -1 : 1;
    // Set the new direction of the second particle
    p2.dx = (p1.x >= p2.x) ? -1 : 1;
    p2.dy = (p1.y >= p2.y) ? -1 : 1;
    // Finish doing code if the two particles are intersecting
  }
  // Finish defining a function to see if the two particles should bounce off
  // each other, given the two particles
}

// Define a function to check if two given particles are intersecting
function isIntersecting(p1, p2) {
  return p1.x < p2.x + P_WIDTH &&
    p2.x < p1.x + P_WIDTH &&
    p1.y < p2.y + P_HEIGHT &&
    p2.y < p1.y + P_HEIGHT;
  // Finish defining a function to check if two given particles are intersecting
}

// Define a function to see if a given particle should bounce off a wall
function checkWallBounce(particle) {
  // Check if the particle should bounce off the left wall
  if (particle.x + particle.dx < 0) {
    particle.dx = 1;
  }
  // Check if the particle should bounce off the right wall
  else if (particle.x + particle.dx > Canvas.width - P_WIDTH) {
    particle.dx = -1;
  }
  // Check if the particle should bounce off the top wall
  if (particle.y + particle.dy < 0) {
    particle.dy = 1;
  }
  // Check if the particle should bounce off the bottom wall
  else if (particle.y + particle.dy > Canvas.height - P_HEIGHT) {
    particle.dy = -1;
  }
  // Finish defining a function to see if a given particle should bounce off a
  // wall
}
