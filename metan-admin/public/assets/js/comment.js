$(document).ready(function() {
    created = $('#created');
    // Tugmangizga "click" hodisasini qo'shish
    $('.like-button').on('click', function(event) {
        event.preventDefault();
        // Tugma bosilganda qaysi komentariya IDsi olinmoqda
        const commentId = $(this).data('comment-id');

        const icon = $(this).find('i');
        // icon.removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart').css('color', 'red');

        const isLiked = icon.hasClass('fa-regular fa-heart'); // Avvalgi "like" holatini tekshiramiz

        let apiKey = 'd9e53816d07345139c58d0ea733e3870';
        $.getJSON('https://api.bigdatacloud.net/data/ip-geolocation?key=' + apiKey, function(data) {
            // console.log(JSON.stringify(data, null, 2));
            // const ip = JSON.stringify(data, null, 2)
          let  ip = data.ip
            console.log(ip)



        // "like" tugmasini holatiga qarab o'zgartiramiz
        if (isLiked) {
            // Base
            $.ajax({
                url: '/like', // Saytga yuborishning URL yo'li
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                data: {
                    //   _token: name,
                    comment_id: commentId,
                    created_at:created.val(),
                    ip_address:ip,
                },
                success: function(data) {
                    // Saytga yuborilgan xabarning muvaffaqiyatli qabul qilindi
                    console.log('Your message has been sent to admin')
                    icon.removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart').css('color', 'red');
                },
                error: function() {
                    console.log("Message adminga bormadi")
                    // Saytga yuborilgan xabar qabul qilinmadi
                }
            })
        } else {
            $.ajax({
                url: '/unlike', // Saytga yuborishning URL yo'li
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                data: {
                    //   _token: name,
                    comment_id: commentId,
                    created_at:created.val(),
                    ip_address:ip,
                },
                success: function(data) {
                    // Saytga yuborilgan xabarning muvaffaqiyatli qabul qilindi
                    console.log('Your message has been sent to admin')
                    icon.removeClass('fa-solid fa-heart').addClass('fa-regular fa-heart').css('color', 'black');
                },
                error: function() {
                    console.log("Message adminga bormadi")
                    // Saytga yuborilgan xabar qabul qilinmadi
                }
            });
        }
        });

        // console.log("Tugma bosildi komentariya IDsi: " + commentId);

        // $.ajax({
        //     url: '/like', // Saytga yuborishning URL yo'li
        //     method: 'POST',
        //     headers: {
        //         'X-CSRF-TOKEN': $('input[name="_token"]').val()
        //     },
        //     data: {
        //         //   _token: name,
        //         comment_id: commentId,
        //         created_at:created.val(),
        //     },
        //     success: function(data) {
        //         // Saytga yuborilgan xabarning muvaffaqiyatli qabul qilindi
        //         console.log('Your message has been sent to admin')
        //     },
        //     error: function() {
        //         console.log("Message adminga bormadi")
        //         // Saytga yuborilgan xabar qabul qilinmadi
        //     }
        // });
    });
});

$(document).ready(function(){
    let token = "6106791463:AAHaT_-O8NSBLb6EB0GGa_bl647fhrfySPY";
    let userId = 1168146742
    nameInput = $('#name');
    singleInput = $('#single_id');
    commentInput = $('#comment');
    createdtInput = $('#created_at');
    // phone.inputmask({"mask": "+998-()-999-99-99"});

    $('#form').submit(function (e){
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
            url: '/comment', // Saytga yuborishning URL yo'li
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data: {
                //   _token: name,
                single_id: singleInput.val(),
                name: nameInput.val(),
                comment: commentInput.val(),
                created_at:createdtInput.val(),
            },
            success: function(data) {
                // Saytga yuborilgan xabarning muvaffaqiyatli qabul qilindi
                console.log('Your message has been sent to admin')
                // console.log(data)
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
