$(document).ready(function(){
    let token = "6106791463:AAHaT_-O8NSBLb6EB0GGa_bl647fhrfySPY";
    let userId = 1168146742
    nameInput = $('#full_name');
    emailInput = $('#news_email');

    // phone.inputmask({"mask": "+998-()-999-99-99"});

    $('#news_form').submit(function (e){
        e.preventDefault();
        // $.ajax({
        //     url:'https://api.telegram.org/bot'+token+'/sendMessage',
        //     method:'POST',
        //     data: {
        //         //   _token: '{{ csrf_token() }}',
        //         chat_id : userId ,
        //         text:
        //             "Name: " + nameInput.val() +
        //             "\n Phone: " + phoneInput.val() +
        //             "\n Etaj: " + etajInput.val()
        //     },
        //     success: function (data){
        //         // $('#form').remove()
        //         console.log('Your message has been sent to bot!');
        //         $('#submit').slideDown();
        //         location.reload()
        //     },
        //     error: function() {
        //         console.log("Message botga bormadi")
        //         // Botga xabar yuborishda xatolik yuz berdi
        //     }
        // });
        $.ajax({
            url: '/news_email', // Saytga yuborishning URL yo'li
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data: {
                //   _token: name,
                full_name: nameInput.val(),
                email: emailInput.val(),
            },
            success: function(data) {
                //alert
                // $('#success').html("<div class='alert alert-success'>");
                // $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                //     .append("</button>");
                // $('#success > .alert-success')
                //     .append("<strong>Your message has been sent. </strong>");
                // $('#success > .alert-success')
                //     .append('</div>');
                // $('#form').trigger("reset");


                // Saytga yuborilgan xabarning muvaffaqiyatli qabul qilindi
                console.log('Your message has been sent to admin')
                // console.log(this.data)
                $('#submit').slideDown();
                location.reload()
            },
            error: function() {
                console.log("Message adminga bormadi")
                // Saytga yuborilgan xabar qabul qilinmadi
            }
        });


    });
});
