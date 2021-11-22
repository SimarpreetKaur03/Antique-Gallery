var testimonials = document.getElementById('testimonials');
    var control1 = document.getElementById('control1');
    var control2 = document.getElementById('control2');
    var control3 = document.getElementById('control3');
    
    
    control1.onclick=function(){
        testimonials.style.transform = "translateX(34%)";
        control1.classList.add("active_review");
        control2.classList.remove("active_review");
        control3.classList.remove("active_review");
    }
    
    control2.onclick=function(){
        testimonials.style.transform = "translateX(0px)";
        control1.classList.remove("active_review");
        control2.classList.add("active_review");
        control3.classList.remove("active_review");
    }
    
    control3.onclick=function(){
        testimonials.style.transform = "translateX(-34%)";
        control1.classList.remove("active_review");
        control2.classList.remove("active_review");
        control3.classList.add("active_review");
    }