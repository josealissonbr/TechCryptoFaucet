<html>
    <head>
        <title>Tech Crypto Faucet</title>
        <link href="{{asset('css/login.css')}}" rel="stylesheet">
        <link href="{{asset('css/loader.css')}}" rel="stylesheet">
        
    </head>
  <body>

    <div id="spinloader" class="loading center" style="display: none">Loading&#8230;</div>
    
    <div id="app">
      @include('home')
    </div>
    
    <script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
  </body>

  <script>  
    function setContentView(name){

        event.preventDefault();
        console.log("loading content")
        //Show Loading div
        document.getElementById('spinloader').setAttribute("style", "display: block;")
        //$("#app").html('<div class="loading center">Loading&#8230;</div>')
        

        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        if (name == "login"){
            $.ajax({

                url:"/auth/login/view",
                type: 'get',
                data:{
                    CSRF_TOKEN
                },
                success:function (data) {
                    //console.log(data);
                    //document.getElementById("navdash").setAttribute("class", " active")
                    
                    $("#app").html(data)
                    
                    
                }
            })
        }else{
            //document.getElementById("navdash").setAttribute("class", "")
        }

        setTimeout(function() {
        document.getElementById('spinloader').setAttribute("style", "display: none;")
        }, 400)
    }

    window.addEventListener('load', function () {
        //alert("It's loaded!")
        //setTab('dashboard');
    })
    
</script>

</html>