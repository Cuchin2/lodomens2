@props(['scale'=>'1'])

<div class="swal-icon swal-icon--success reduced">
    <span class="swal-icon--success__line swal-icon--success__line--long"></span>
    <span class="swal-icon--success__line swal-icon--success__line--tip"></span>

    <div class="swal-icon--success__ring"></div>
    <div class="swal-icon--success__hide-corners"></div>
</div>
@push('styles')
<style>
    /* icono success */
.swal-icon--success{
    border-color:/* #a5dc86 */#10B981;
}
.swal-icon--success:after,.swal-icon--success:before{
    content:"";
    border-radius:50%;
    position:absolute;
    width:60px;
    height:120px;
    background:#1C1C1C;
    -webkit-transform:rotate(45deg);
    transform:rotate(45deg)
}
.swal-icon--success:before{
    border-radius:120px 0 0 120px;
    top:-7px;
    left:-33px;
    -webkit-transform:rotate(-45deg);
    transform:rotate(-45deg);
    -webkit-transform-origin:60px 60px;
    transform-origin:60px 60px
}
.swal-icon--success:after{
    border-radius:0 120px 120px 0;
    top:-11px;
    left:30px;
    -webkit-transform:rotate(-45deg);
    transform:rotate(-45deg);
    -webkit-transform-origin:0 60px;
    transform-origin:0 60px;
    -webkit-animation:rotatePlaceholder 4.25s ease-in;
    animation:rotatePlaceholder 4.25s ease-in
}
.swal-icon--success__ring{
    width:80px;
    height:80px;
    border:4px solid /* hsla(98,55%,69%,.2); */hsla(153, 85%, 37%, 0.6);
    border-radius:50%;
    box-sizing:content-box;
    position:absolute;
    left:-4px;
    top:-4px;
    z-index:2
}
.swal-icon--success__hide-corners{
    width:5px;
    height:90px;
    background:#1C1C1C;
    padding:1px;
    position:absolute;
    left:28px;
    top:8px;
    z-index:1;
    -webkit-transform:rotate(-45deg);
    transform:rotate(-45deg)
}
.swal-icon--success__line{
    height:5px;
    background-color:/* #a5dc86; */#10B981;
    display:block;
    border-radius:2px;
    position:absolute;
    z-index:2
}
.swal-icon--success__line--tip{
    width:25px;
    left:14px;
    top:46px;
    -webkit-transform:rotate(45deg);
    transform:rotate(45deg);
    -webkit-animation:animateSuccessTip .75s;
    animation:animateSuccessTip .75s
}
.swal-icon--success__line--long{
    width:47px;
    right:8px;
    top:38px;
    -webkit-transform:rotate(-45deg);
    transform:rotate(-45deg);
    -webkit-animation:animateSuccessLong .75s;
    animation:animateSuccessLong .75s
}
@-webkit-keyframes rotatePlaceholder{
    0%{
        -webkit-transform:rotate(-45deg);
        transform:rotate(-45deg)
    }
    5%{
        -webkit-transform:rotate(-45deg);
        transform:rotate(-45deg)
    }
    12%{
        -webkit-transform:rotate(-405deg);
        transform:rotate(-405deg)
    }
    to{
        -webkit-transform:rotate(-405deg);
        transform:rotate(-405deg)
    }
}
@keyframes rotatePlaceholder{
    0%{
        -webkit-transform:rotate(-45deg);
        transform:rotate(-45deg)
    }
    5%{
        -webkit-transform:rotate(-45deg);
        transform:rotate(-45deg)
    }
    12%{
        -webkit-transform:rotate(-405deg);
        transform:rotate(-405deg)
    }
    to{
        -webkit-transform:rotate(-405deg);
        transform:rotate(-405deg)
    }
}
@-webkit-keyframes animateSuccessTip{
    0%{
        width:0;
        left:1px;
        top:19px
    }
    54%{
        width:0;
        left:1px;
        top:19px
    }
    70%{
        width:50px;
        left:-8px;
        top:37px
    }
    84%{
        width:17px;
        left:21px;
        top:48px
    }
    to{
        width:25px;
        left:14px;
        top:45px
    }
}
@keyframes animateSuccessTip{
    0%{
        width:0;
        left:1px;
        top:19px
    }
    54%{
        width:0;
        left:1px;
        top:19px
    }
    70%{
        width:50px;
        left:-8px;
        top:37px
    }
    84%{
        width:17px;
        left:21px;
        top:48px
    }
    to{
        width:25px;
        left:14px;
        top:45px
    }
}
@-webkit-keyframes animateSuccessLong{
    0%{
        width:0;
        right:46px;
        top:54px
    }
    65%{
        width:0;
        right:46px;
        top:54px
    }
    84%{
        width:55px;
        right:0;
        top:35px
    }
    to{
        width:47px;
        right:8px;
        top:38px
    }
}
@keyframes animateSuccessLong{
    0%{
        width:0;
        right:46px;
        top:54px
    }
    65%{
        width:0;
        right:46px;
        top:54px
    }
    84%{
        width:55px;
        right:0;
        top:35px
    }
    to{
        width:47px;
        right:8px;
        top:38px
    }
}
.swal-icon{
    width:80px;
    height:80px;
    border-width:4px;
    border-style:solid;
    border-radius:50%;
    padding:0;
    position:relative;
    box-sizing:content-box;
    margin:0px auto
}
.reduced {
    transform: scale({{ $scale }});
}
</style>
@endpush