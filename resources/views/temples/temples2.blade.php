<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .carousel-container {
          position: relative;
          width: 100%;
          max-width: 800px;
          overflow: hidden;
          margin: auto;
        }
        
        .carousel-track {
          display: flex;
          transition: transform 0.5s ease;
        }
        
        .card {
          min-width: 33.33%;  /* Display 3 cards at a time */
          box-sizing: border-box;
          padding: 20px;
          background: #f4f4f4;
          border-radius: 10px;
          text-align: center;
          transition: transform 0.5s ease;
        }
        
        .control {
          position: absolute;
          top: 50%;
          transform: translateY(-50%);
          background: rgba(0,0,0,0.5);
          color: white;
          border: none;
          padding: 10px;
          cursor: pointer;
        }
        
        .prev {
          left: 10px;
        }
        
        .next {
          right: 10px;
        }
        
        .dots {
          display: flex;
          justify-content: center;
          margin-top: 10px;
        }
        
        .dot {
          width: 10px;
          height: 10px;
          margin: 0 5px;
          border-radius: 50%;
          background-color: #ccc;
          cursor: pointer;
          transition: background-color 0.3s;
        }
        
        .dot.active {
          background-color: #333;
        }
        </style>
</head>
<body>
    <div class="carousel-container">
        <div class="carousel-track" id="track">
          <div class="card">
            <h2>Card 1</h2>
            <p>Details 1</p>
          </div>
          <div class="card">
            <h2>Card 2</h2>
            <p>Details 2</p>
          </div>
          <div class="card">
            <h2>Card 3</h2>
            <p>Details 3</p>
          </div>
          <div class="card">
            <h2>Card 4</h2>
            <p>Details 4</p>
          </div>
          
          <!-- Duplicate slides for infinite scrolling -->
          <div class="card">
            <h2>Card 1</h2>
            <p>Details 1</p>
          </div>
          <div class="card">
            <h2>Card 2</h2>
            <p>Details 2</p>
          </div>
          <div class="card">
            <h2>Card 3</h2>
            <p>Details 3</p>
          </div>
        </div>
        <button class="control prev" onclick="prevSlide()">❮</button>
  <button class="control next" onclick="nextSlide()">❯</button>
  
  <div class="dots" id="dots"></div>
</body>
<script>
    let currentIndex = 0;
    const track = document.getElementById('track');
    const totalSlides = track.children.length;
    const slidesToShow = 3; // Display 3 slides at once
    const dotsContainer = document.getElementById('dots');
    
    // Update the current slide position
    function updateSlide() {
        console.log(currentIndex);
      track.style.transform = 'translateX(' + (-currentIndex * (100 / slidesToShow)) + '%)';
    
      // Update active dot
      const dots = document.querySelectorAll('.dot');
      dots.forEach((dot, index) => {
        if (index === currentIndex) {
          dot.classList.add('active');
        } else {
          dot.classList.remove('active');
        }
      });
    
    //   Check if we reached the duplicate slides and reset to original
      if (currentIndex >= totalSlides - slidesToShow) {
        setTimeout(() => {
          track.style.transition = 'none';  // Remove transition temporarily
          currentIndex = 0;  // Reset to first slide
          updateSlide();
        }, 500);  // Wait for the current transition to finish
      } else {
        track.style.transition = 'transform 0.5s ease';  // Apply transition back
      }
    }
    
    // Move to next slide
    function nextSlide() {
      currentIndex = (currentIndex + slidesToShow) % totalSlides;
      updateSlide();
    }
    
    // Move to previous slide
    function prevSlide() {
      currentIndex = (currentIndex - slidesToShow + totalSlides) % totalSlides;
      updateSlide();
    }
    
    // Create dots dynamically
    for (let i = 0; i < Math.ceil(totalSlides / slidesToShow); i++) {
      const dot = document.createElement('div');
      dot.classList.add('dot');
      dot.addEventListener('click', () => {
        currentIndex = i;
        updateSlide();
      });
      dotsContainer.appendChild(dot);
    }
    
    // Initialize the first dot as active
    updateSlide();
    </script>
</html>