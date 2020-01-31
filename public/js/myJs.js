webpackJsonp([2],{

/***/ 367:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(368);


/***/ }),

/***/ 368:
/***/ (function(module, exports) {

var timeout;

// save button get value search map
$('#save_value').click(function () {
    var checkvalue = [];
    $(':checkbox:checked').each(function () {
        checkvalue.push(parseInt($(this).val()));
    });
    // console.log(checkvalue);
});

var dynamicInput = [];
var ct = 1;
function new_link() {
    ct++;
    var div1 = document.createElement('div');
    div1.id = dynamicInput[ct];
    // link to delete extended form elements
    var delLink = '<div class ="row"><div class ="col-sm-2"></div><div class ="col-sm-9"></div><div class="col-sm-1"><a class="text-danger" style="padding-top: 1px;" href="javascript:delIt(' + ct + ')">  delete </a>  </div> </div>  ';
    div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
    document.getElementById('newlink').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt(eleId) {
    d = document;
    var ele = d.getElementById(eleId);
    var parentEle = d.getElementById('newlink');
    parentEle.removeChild(ele);
}

function DeltArr(index, type) {
    if (type == '0') {
        type = 'photo';
    }
    if (type == '1') {
        type = 'video';
    }
    if (type == '2') {
        type = 'cooperation';
    }
    if (type == '3') {
        type = 'payment';
    }

    var isDivThere = $('#gallery-' + type + ' #gallery-' + type + index + '').index();

    var j_arr = $('#galleryarea-' + type + '' + index + '').attr('class').split("_");
    var j_indx = j_arr[1];

    var eleId = 'gallery-' + type + index;
    var ele = document.getElementById(eleId);
    var getId = 'gallery-' + type;
    var parentEle = document.getElementById(getId);
    parentEle.removeChild(ele);

    var next_id;
    var getClass = 'gallery-area-' + type;
    var photo = document.getElementsByClassName(getClass);

    for (var i = j_indx; i < photo.length; i++) {
        var new_index = Number(i) + Number(1);
        var oldClass = 'gallery_' + i;
        var newClass = 'gallery_' + new_index;

        $('div.gallery-area-' + type + '').each(function (index, value) {
            if (Number(index) == Number(isDivThere)) {
                var next_arr = $(this).attr('id').split(type);
                next_id = next_arr[1];
            }
        });

        $('#gallery-' + type + next_id + ' .gallery-area-' + type).removeClass(newClass);
        $('#gallery-' + type + next_id + ' .gallery-area-' + type).addClass(oldClass);

        isDivThere++;
    }
}

/*select check

*/
// $(document).ready(function(){
$('.select_all').on('click', function () {
    if (this.checked) {
        $('.checkbox').each(function () {
            this.checked = true;
        });
    } else {
        $('.checkbox').each(function () {
            this.checked = false;
        });
    }
});

$('.checkbox').on('click', function () {
    if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('.select_all').prop('checked', true);
    } else {
        $('.select_all').prop('checked', false);
    }
});

$(".checkbox").on("click", function () {
    if ($(".checkbox:checked").length == $(".checkbox").length) {
        $(".select_all").prop("checked", true);
    } else {
        $(".select_all").prop("checked", false);
    }
});

/* start nurse profile*/

// $(".readMore").click(function() {
//   var elem = $(".readMore").text();
//   if (elem == "ReadMore") {
//     //Stuff to do when btn is in the read more state
//     $(".readMore").text("ReadLess");
//     $(".displaytext").slideDown();
//   } else {
//     //Stuff to do when btn is in the read less state
//     $(".readMore").text("ReadMore");
//     $(".displaytext").slideUp();
//   }
// });

/* end nurse profile*/

function closeBtnPreview(indx, sec) {
    if (confirm("Are you sure you want to delete?")) {
        var panorama_preview = document.getElementById('preview-panorama' + indx + 'indx' + sec);
        panorama_preview.parentNode.removeChild(panorama_preview);
    }
}

function showImg(c, event) {
    $("." + c).html("<img src='" + URL.createObjectURL(event.target.files[0]) + "' class='show-img'>");
}

$("select").on("click", function () {

    $(this).parent(".select-box").toggleClass("open");
});

$(document).mouseup(function (e) {
    var container = $(".select-box");

    if (container.has(e.target).length === 0) {
        container.removeClass("open");
    }
});

$("select").on("change", function () {

    var selection = $(this).find("option:selected").text(),
        labelFor = $(this).attr("id"),
        label = $("[for='" + labelFor + "']");

    label.find(".label-desc").html(selection);
});
function closevideo() {
    alert('Are you sure to delete?');
    var file = document.getElementById("upload_file").files[0];
    var file_path = 'upload/videos/' + file.name;

    var url = "/api/customer/deletevideo";
    $.ajax({
        type: 'post',
        data: { "fiel_path": file_path },
        url: url,
        success: function success(data) {
            $('#video-area').remove();
        }
    });
}

function new_link() {
    ct++;
    var div1 = document.createElement('div');
    div1.id = dynamicInput[ct];
    // link to delete extended form elements
    var delLink = '<div class ="row"><div class ="col-sm-2"></div><div class ="col-sm-9"></div><div class="col-sm-1"><a class="text-danger" style="padding-top: 1px;" href="javascript:delIt(' + ct + ')">  delete </a>  </div> </div>  ';
    div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
    document.getElementById('newlink').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt(eleId) {
    d = document;
    var ele = d.getElementById(eleId);
    var parentEle = d.getElementById('newlink');
    parentEle.removeChild(ele);
}

function DeltArr(index, type) {
    if (type == '0') {
        type = 'photo';
    }
    if (type == '1') {
        type = 'video';
    }
    if (type == '2') {
        type = 'cooperation';
    }
    if (type == '3') {
        type = 'payment';
    }

    var isDivThere = $('#gallery-' + type + ' #gallery-' + type + index + '').index();

    var j_arr = $('#galleryarea-' + type + '' + index + '').attr('class').split("_");
    var j_indx = j_arr[1];

    var eleId = 'gallery-' + type + index;
    var ele = document.getElementById(eleId);
    var getId = 'gallery-' + type;
    var parentEle = document.getElementById(getId);
    parentEle.removeChild(ele);

    var next_id;
    var getClass = 'gallery-area-' + type;
    var photo = document.getElementsByClassName(getClass);

    for (var i = j_indx; i < photo.length; i++) {
        var new_index = Number(i) + Number(1);
        var oldClass = 'gallery_' + i;
        var newClass = 'gallery_' + new_index;

        $('div.gallery-area-' + type + '').each(function (index, value) {
            if (Number(index) == Number(isDivThere)) {
                var next_arr = $(this).attr('id').split(type);
                next_id = next_arr[1];
            }
        });

        $('#gallery-' + type + next_id + ' .gallery-area-' + type).removeClass(newClass);
        $('#gallery-' + type + next_id + ' .gallery-area-' + type).addClass(oldClass);

        isDivThere++;
    }
}

var ct = 1;

function new_link() {
    ct++;
    var div1 = document.createElement("div");
    div1.id = ct;
    // link to delete extended form elements
    var delLink = '<div class ="row"><div class ="col-sm-2"></div><div class ="col-sm-9"></div><div class="col-sm-1"><a class="text-danger" style="padding-top: 1px;" href="javascript:delIt(' + ct + ')">  delete </a>  </div> </div>  ';
    div1.innerHTML = document.getElementById("newlinktpl").innerHTML + delLink;
    document.getElementById("newlink").appendChild(div1);
}
// function to delete the newly added set of elements
function delIt(eleId) {
    d = document;
    var ele = d.getElementById(eleId);
    var parentEle = d.getElementById("newlink");
    parentEle.removeChild(ele);
}

/***/ })

},[367]);