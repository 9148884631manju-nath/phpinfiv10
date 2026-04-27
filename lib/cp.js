function cartpayx(){$(".cartpay").click(function(){dis=$(this);po=dis.attr("cartpay").split("|");postfle(po[0],po[1],po[2],po[3]);});}
var something = (function() {
    var executed = false;
    return function() {
        if (!executed) {
            cartpayx();
        }
    };
})();

something();