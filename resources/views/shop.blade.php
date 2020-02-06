<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
       
            }

            .full-height {
                height: 100vh;
            }

    
        </style>
<script src="https://js.paystack.co/v1/inline.js"></script>

<script type="text/javascript"
src= 
"https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> 
</script> 

        <script>

function payWithPaystack( price ,id ){
    var handler = PaystackPop.setup({
      key: 'pk_test_39a8567daa4cd75bb5b36a2975fc0a2c7d9773f3',
      email: 'customer@email.com',
      amount:  price * 100,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
         ]
      },
      callback: function(response){
          // alert('success. transaction ref is ' + verifyMe(response.reference));
          verifyMe(response.reference)
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }
        
          function verifyMe(ref){
            $.get( 
                 `buyme/${ref}`, { 
                    
                 }, 
                 function(data) { 
                     $('#stage').html(data); 
            })
          }  

        </script>
    </head>
        <body>
            <div class="">
            <div class="container">
      <div class="row">
        <div class="col-sm">

          <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80" style="width: inherit;
          height: inherit;
    " >
          <p>Bag</p>
          <p>

            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid eveniet obcaecati architecto reiciendis aperiam?
            Soluta culpa dolores dignissimos pariatur delectus explicabo placeat officia fuga tempora consectetur sunt, ut laborum. Consequatur.

          </p>
          
          <button  onclick="payWithPaystack(1000,1)" >
            Buy me nigga!
          </button>
          
        </div>
        <div class="col-sm">
          One of thrssssee columns
        </div>
        <div class="col-sm">
          One of tdhree columns
        </div>
      </div>
    </div>
        
        </div>
    </body>
</html>
