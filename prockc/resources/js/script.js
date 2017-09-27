

$('.pic_user').click(function  () {
  $('.user_menu').slideToggle();
})


// $.getJSON( "phone.json", function( data ) {
 
//     var items = [];
//   data.forEach(function(datas){
//   	console.log(datas.dial_code);
//   	$('#number_selc').append("<option>"+datas.dial_code+"</option>")

//   })

//  });

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#upImg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


var filName
 $('#choose_f').change(function(e){
        readURL(this);

        var f = e.target.files,
            len = f.length;
     fileName=f[0].name;
     console.log(f[0])
     $(".div_choose span").text(fileName);
     

 })

