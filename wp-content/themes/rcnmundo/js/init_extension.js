
$( document ).ready(function() {
    function DropDown(el) {
        this.dd = el;
        this.placeholder = this.dd.children('span');
        this.opts = this.dd.find('ul.dropdown > li');
        this.val = '';
        this.index = -1;
        this.initEvents();
    }
    DropDown.prototype = {
        initEvents : function() {
            var obj = this;

            obj.dd.on('click', function(event){
                $(this).toggleClass('active');
                return false;
            });

            obj.opts.on('click',function(){
                var opt = $(this);
                obj.val = opt.text();
                obj.index = opt.index();
                obj.placeholder.text('Ciudad: ' + obj.val);
            });
        },
        getValue : function() {
            return this.val;
        },
        getIndex : function() {
            return this.index;
        }
    }

    $(function() {

        var dd = new DropDown( $('#dd') );
        var dd2 = new DropDown( $('#dd2') );

        $(document).click(function() {
            // all dropdowns
            $('.wrapper-dropdown-1').removeClass('active');
            
        });

    });
$('#mask').carouFredSel({
    scroll : {
        easing            : "elastic",
        duration        : 1200,
        pauseOnHover    : true
    },
    prev: '#prev',
    next: '#next',
    responsive: true,
        width: '100%',
        scroll: 3,
        items: {
            width: 70,
            visible: {
                min: 3,
                max: 6
            }
        }
});

function vrmask(){
    $('#maskr').carouFredSel({ 
        auto:false,
        prev: '#prev_r',
        next: '#next_r',
        swipe:true,
        responsive: true,
            width: '100%',
            scroll: 3,
            items: {
                width: 200,
                visible: {
                    min: 1,
                    max: 4
                }
            }
    });   
}
vrmask();
});