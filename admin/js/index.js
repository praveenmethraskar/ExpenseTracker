        // profile panel
        const menu = document.getElementById("profileMenu");
        const menuBtn =  document.querySelector(".profileIcon");

        menuBtn.addEventListener("click",function(){
            menu.classList.toggle("show");
            setTimeout(() => {
                menu.style.overflow = "visible";
            }, 300);
            menu.style.overflow = "hidden";
        })
        
        document.addEventListener("click",function(e){
            if(e.target !== menuBtn && !menu.contains(e.target)){
                menu.classList.remove("show");
            }
        })
        // profile panel

        // hambargar
        const hmb = document.querySelector(".hambargar");
        const navul = document.querySelector(".hero nav ul");

        var x = window.matchMedia("(max-width: 700px)");

        x.addEventListener("change", function() {
            navul.classList.remove("show");
            menu.classList.remove("show");
            hmb.classList.remove("active");
        });
        hmb.addEventListener("click",function(){
            navul.classList.toggle("show");
            hmb.classList.toggle("active");
        })

        document.addEventListener("click",function(e){
            if(e.target !== hmb && !navul.contains(e.target)){
                navul.classList.remove("show");
                hmb.classList.remove("active");
            }
        })
        // hambargar


        //حذيفة