require('./bootstrap');

$(".show-sidebar-btn").click(function () {
    $(".sidebar").animate({marginLeft:0});
});

$(".hide-sidebar-btn").click(function () {
    $(".sidebar").animate({marginLeft:"-100%"});
});

// sidebar dropdown
$('.sub-btn').click(function () {
    $(this).next('.sub-menu').slideToggle();
    $(this).find('.custom-dropdown').toggleClass('rotate')
})

$(".full-screen-btn").click(function () {
    // console.log('click')
    let current = $(this).closest(".card");
    current.toggleClass("full-screen-card");
    if(current.hasClass("full-screen-card")){
        $(this).html(`<i class="fa fa-compress" style="font-size: 16px"></i>`);
    }else{
        $(this).html(`<i class="fa fa-expand" style="font-size: 16px"></i>`);
    }
});

// loader
let spinner = function () {
    setTimeout(function () {
        if ($('#spinner').length > 0) {
            $('#spinner').removeClass('show');
        }
    }, 1);
};
spinner();

let screenHeight = $(window).height();

let currenMenuHeight = $(`.nav-menu .currentPage`).offset().top;

if (currenMenuHeight > screenHeight*0.8){
    $(".sidebar").animate({
        scrollTop: currenMenuHeight-100
    },1000)
}


Array.prototype.forEach.call(
    document.querySelectorAll(".file-upload__button"),
    function(button) {
        const hiddenInput = button.parentElement.querySelector(
            ".file-upload__input"
        );
        const label = button.parentElement.querySelector(".file-upload__label");
        const defaultLabelText = "No file(s) selected";

        // Set default text for label
        label.textContent = defaultLabelText;
        label.title = defaultLabelText;

        button.addEventListener("click", function() {
            hiddenInput.click();
        });

        hiddenInput.addEventListener("change", function() {
            const filenameList = Array.prototype.map.call(hiddenInput.files, function(
                file
            ) {
                return file.name;
            });

            label.textContent = filenameList.join(", ") || defaultLabelText;
            label.title = label.textContent;
        });
    }
);

// profile
let upload = document.getElementById("upload");
let preview = document.getElementById("preview");
const reader = new FileReader();

upload.addEventListener("change",function (){
    // console.log("upload");
    let photo = this.files[0];
    reader.addEventListener("load",function (){
        preview.src = reader.result;
    });
    reader.readAsDataURL(photo);
});
