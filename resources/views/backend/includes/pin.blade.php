<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/backend/css/bootstrap.min.css') }}" media="screen">
</head>
<body>
<img src="{{asset('easypin/condition.jpg')}}" width="800"  class="pin" easypin-id="jizLvySUzI">
 <!-- dialog window -->
 <div class="easy-modal" role="dialog" style="display:none;" modal-position="free">
    <form style="direction: rtl;">
        <div class="form-group">
            <label>ما هى المشكلة؟</label>
            <input type="text" class="form-control" name="content" placeholder="وصف المشكلة" />
        </div>
        <button type="button" class="btn btn-primary easy-submit">حفظ</button>
    </form>
</div>
<div id="points">

</div>
<!-- popover -->
<div style="display:none;" width="130" shadow="true" popover="">
    <div style="width:100%;text-align:center;">{[content]}</div>
</div>


<script src="{{asset('easypin')}}/jquery-2.2.0.min.js"></script>
<script src="{{asset('easypin')}}/jquery.easing.min.js"></script>
<script src="{{asset('easypin')}}/jquery.easypin.js"></script>
<script type="text/javascript">
    var cord = getQueryParam("cord");
    var name = getQueryParam("name");
    if(cord && name){
        var cords = cord.split(",");
        var $instance = $('.pin').easypin({
            init: '{"jizLvySUzI":{"0":{"content":"'+name+'","coords":{"lat":"'+cords[0]+'","long":"'+cords[1]+'"}},"canvas":{"src":"{{asset('easypin/condition.jpg')}}","width":"950","height":"562"}}}',
            //limit:1,
            drop: function(x, y, element) {

                $('.points', parent.document).val(x+","+y);
            },
            drag: function(x, y, element) {
                $('.points', parent.document).val(x+","+y);
            }
        });
    }else{
        var $instance = $('.pin').easypin({
            //init: '{"jizLvySUzI":{"0":{"content":"Ashraf Test","coords":{"lat":"70","long":"107"}},"canvas":{"src":"{{asset('easypin/avengers.jpg')}}","width":"950","height":"562"}}}',
            //limit:1,
            drop: function(x, y, element) {
                var markerIndex = element.attr('data-index');
                addCordDataForm(markerIndex,x,y);
            },
            drag: function(x, y, element) {
                //console.log(element.attr('data-index'));
                var markerIndex = element.attr('data-index');
                addCordDataForm(markerIndex,x,y);
                //$('#points', parent.document).val(x+","+y);
            }
        });
    }
    function getQueryParam(param) {
        var result =  window.location.search.match(
            new RegExp("(\\?|&)" + param + "(\\[\\])?=([^&]*)")
        );

        return result ? result[3] : false;
    }
    function addCordDataForm(markerIndex,x,y){
        var container = $("#points").find(".row-"+markerIndex);
        if(container.length){
            container.find(".x").val(x);
            container.find(".y").val(y);
        }else{
            $("#points").append('<div class="row-'+markerIndex+'"> <input class="pinname" type="text" value="" name="cord['+markerIndex+'][name]"/> <input class="x" type="text" value="'+x+'" name="cord['+markerIndex+'][x]"/> <input class="y" type="text" value="'+y+'" name="cord['+markerIndex+'][y]"/> </div>');
        }
    }
</script>
</body>
</html>
