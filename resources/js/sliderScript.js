function onchangeSliderChildren() {
    let count = $(".slider_item").length;
    $(".range_slider").attr("max", count - 4);
    $(".slider_item").hover(
        function() {
            $(this).css("border", "2px solid black");
            $(".name", this).css("color", " #575757");
            $(".additionalInfo", this).css("color", " #575757");

            $(".itemPhoto", this).stop().fadeOut(400);
            $(".messager", this).css("display", "flex").stop().fadeIn(400);
        },
        function() {
            $(this).css("border", "2px solid rgb(206, 206, 206)");
            $(".name", this).css("color", "black");
            $(".additionalInfo", this).css("color", "black");

            $(".messager", this).stop().fadeOut(400);
            $(".itemPhoto", this).stop().fadeIn(400);
        }
    );

    let positionPX = 0;
    let position = 1;
    const wrapper = $(".slider_wrapper");

    let movePX = 0;

    function Translate() {
        if (this.value > position) {
            movePX = (Number(this.value) - Number(position)) * 234;
            positionPX -= movePX;
            wrapper.css({ transform: `translateX(${positionPX}px)` });
        } else {
            movePX = Math.abs(Number(this.value) - Number(position)) * 234;
            positionPX += movePX;
            wrapper.css({ transform: `translateX(${positionPX}px)` });
        }
        position = this.value;
        console.log("after " + position);
    }

    function TranslateKey(direction) {
        if (direction == "right") {
            if (Number($(".range_slider").attr("max")) > position) {
                $(".range_slider").val(++position);
                console.log(position);
                positionPX -= 234;
                wrapper.css({ transform: `translateX(${positionPX}px)` });
            }
        } else {
            if (Number($(".range_slider").attr("min")) < position) {
                $(".range_slider").val(--position);
                positionPX += 234;
                wrapper.css({ transform: `translateX(${positionPX}px)` });
            }
        }
    }
    $(".range_slider").mousedown(function() { $(".range_slider").on("input", Translate) });
    $(".range_slider").mouseup(function() { this.blur() });

    $(document).keydown(function(event) {
        if (event.code == "ArrowRight") TranslateKey("right");
        else if (event.code == "ArrowLeft") TranslateKey("left");
    });
};
const clearSlider = () => $(".slider_wrapper").empty();
const setDefaultBtnColor = () => $(".mainControll").css("color", "#FEFF77");