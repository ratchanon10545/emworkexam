<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- @vite('resources/css/app.css') --}}
    <style>
        .container{
            display:flex;
            gap: 10px;
            justify-content: center;
            /* border: 2px solid #ccc; */
            width: 70%;
            overflow: hidden;
        }
        .image-container {
          width: 300px;
          height: 300px;
          overflow: hidden;
          position: relative;
          cursor: pointer;
          transition: transform 0.5s, opacity 0.5s;
          flex-shrink: 0;
        }
        .image-container img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          object-position: center;
          opacity: 0.6;
          transition:opacity 0.3s ease;
        }
        .image-container:hover img {
            opacity: 1;
        }
        .title{
            display: flex;
            justify-content: center;
        }
        .text{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50% , -50%) ;
            opacity: 1;
            
        }
        .move {
            transform: translateX(-50px);
            opacity: 0;
            }

        .test{
            width:100%;
            /* border: 1px solid red; */
            display: flex;
            justify-content: center;
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
          background-color: #868686;
        }
      </style>
    
</head>
<body>
    <div class="title">
        <h1>Title</h1>
    </div >
    <div class="test">
        <div class="container" id="box">
            @foreach ($datas as $data)
            <div class="image-container">
                <img src="{{$data->path}}" class="target" alt="Crop Image">
                <h1 class="text">Text{{$data->id}}</h1>
              </div>
            @endforeach
            
        </div>
    </div>
    <div class="dots" id="dots"></div>
</body>
<script>
    const container = document.getElementById('box');
    let currentIndex = 0;
    const totalSlides = container.children.length;
    const dotsContainer = document.getElementById('dots');
    // setInterval(() => {
    //   const firstItem = container.children[0];
  
    //   // ขยับตัวแรกออกไปขวา
    //   firstItem.classList.add('move');
  
    //   setTimeout(() => {
    //     // ลบตัวแรกออก
    //     container.removeChild(firstItem);
  
    //     // สร้างตัวใหม่ต่อท้าย (clone แล้ว reset)
    //     const newItem = firstItem.cloneNode(true);
    //     newItem.classList.remove('move');
    //     container.appendChild(newItem);
    //   }, 500); // ให้ effect วิ่งก่อนค่อย remove
  
    // }, 4000 ); // ทำทุก 1 วิ

    function updateSlide() {
        container.style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
      
      // Update active dot
      const dots = document.querySelectorAll('.dot');
      dots.forEach((dot, index) => {
        if (index === currentIndex) {
          dot.classList.add('active');
        } else {
          dot.classList.remove('active');
        }
      });
    }

    // Create dots dynamically
    for (let i = 0; i < totalSlides; i++) {
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