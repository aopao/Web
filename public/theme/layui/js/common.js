var doblur = true;

function toggle_paper_share(evt){
    if (window.event) {  
        event.cancelBubble = true;  
    }else if (evt){  
        evt.stopPropagation();  
    }
    $('.paper_share').toggle();
}

$(function(){
    $('#search_BTN,span.s_click').mouseover(function(){
        doblur = false;
    }).mouseout(function(){
        doblur = true;
    });

    $('#search_BTN').click(function(){
        var input = $(this).closest('span').find('input:text');

        if(input.val()!=""){
            input.closest('form').submit();
        } else {
            input.focus();
        }
    });

    $('span.s_click').click(function(){
        var input = $(this).closest('div').find('input:text');

        if(input.val()!=""){
            input.closest('form').submit();
        } else {
            input.focus();
        }
    });

    $(".friend_link a").last().css("border-right","0");
    $(".team_list").last().css("margin-right","auto");
    $(".student_list").eq(1).addClass("ml87");
    $(".student_list").eq(3).addClass("ml87");
    //$(".paper_share").hide();
    //$(".article_share").hide();
    //$(".article_slidivshow").hide();
    var $article_slider=$("#view .article_slider").length;
    var num=0;
    var v=0;
    var h=0;
    var t=0;
    if (screen.width >= 1131)
    {
	$(".topic_ar .article_slider").each(function(){
            t=t+1;
            if(t%3==0)
            {
                $(this).css("margin-right","0");
            }
        })
        
        $("#view .article_slider").each(function(){
            num=num+1;
            if(num%2!=0)
            {
                $("#view .article_slider").eq(num).css("float","right");
            }
           
        })
	$(".tool_list").each(function(){
            v=v+1;
            if(v%2!=0)
            {
                $(".tool_list").eq(v).css("padding-left","44px").css("width","312px");
            }
	})

        $(".video_t_box .article_slider").each(function(){
            h=h+1;
            if(h%3==0)
            {
                $(this).eq(v).css("margin-right","0");
            }
        })

    }

    if (screen.width < 1131)
    {
        $(".student_list").eq(3).css("margin-right","auto");
        $(".team_list").last().css("margin-right","auto");
		
		$(".link_img2").toggle(function(){
        $(".mobile_linkr").show()
        },function(){
            $(".mobile_linkr").hide()
    	})
    }
    /*移动端点击出现菜单*/
    $("#menu").toggle(function(){
        $(this).parent(".menu").addClass("addmenu");
        $(".mobile_Header").css("padding","0");
        $(".menu").css("text-align","center").css("width","19%");
        $(".top_r").css("float","left");
        $(this).attr("src",THEME+"images/menu1.png");
        $(this).parent().parent().addClass("mobliebg");
        $(".moblie_logos").hide();
        $(".mobile_search").hide();
        $(".top_r").show();
        $(".moblie_menulist").slideDown();
    },function(){
        $(this).parent(".menu").removeClass("addmenu");
        $(".mobile_Header").css("padding","10px 20px 10px 0");
        $(".menu").css("text-align","center").css("width","19%");
        $(this).attr("src",THEME+"images/menu.png");
        $(this).parent().parent().removeClass("mobliebg");
        $(".moblie_logos").show();
        $(".mobile_search").show();
        $(".top_r").hide();
        $(".moblie_menulist").slideUp();
    })

    //返回顶部代码
    $(".backtop").click(function(){
        $("body,html").animate({scrollTop:0},500);
    })

    //右侧悬浮框
    $(window).on('scroll',function(){
        if ($(document).width() < 1131)
        {
            $(".index_right").css("display","none");
            return false;
        }
        var Stop=$(window).scrollTop();
        if(Stop>200)
        {
            $(".index_right").fadeIn("slow");
        }
        if(Stop<200)
        {
           $(".index_right").fadeOut("slow");
        }

        if($("#m_box1").size() != 0) {
            var divH1=$("#m_box1").offset().top;
            var divH2=$("#m_box4").offset().top;
            var divH3=$("#m_box5").offset().top;
            var divH4=$("#m_box6").offset().top;
            var divH5=$("#m_box7").offset().top;
            var divH6=$(".offsettops").offset().top;
            //alert(divH1+".."+divH2+".."+divH3+".."+divH4+".."+divH5);
	   
            var Stop1=$(window).scrollTop();
            var divtop=$(".cer_title").offset().top;
            var s2=$(".offsettops").offset().top;
            //alert(s2);
            //alert(divtop);
            if(Stop1>766&&Stop1<s2)
            {
                $(".cer_title").addClass("divposition");
            }
            else
            {
                $(".cer_title").removeClass("divposition");
            }

            var Stop2=$(window).scrollTop();

            if(Stop2>divH1-50&&Stop2<divH2-236)
            {
                //alert("1");
                $(".cer_title li").removeClass("cer_t_c");
                $(".cer_title li:eq(0)").addClass("cer_t_c");
            }
            else if(Stop2>divH2-235&&Stop2<divH3-233)
            {
                $(".cer_title li").removeClass("cer_t_c");
                $(".cer_title li:eq(1)").addClass("cer_t_c");
            }
            else if(Stop2>divH3-232&&Stop2<divH4-392)
            {
                $(".cer_title li").removeClass("cer_t_c");
                $(".cer_title li:eq(2)").addClass("cer_t_c");
            }
        
            else if(Stop2>divH4-391&&Stop2<divH5-262)
            {
                $(".cer_title li").removeClass("cer_t_c");
                $(".cer_title li:eq(3)").addClass("cer_t_c");
            }
            else if(Stop2>divH5-261&&Stop2<divH6)
            {
                $(".cer_title li").removeClass("cer_t_c");
                $(".cer_title li:eq(4)").addClass("cer_t_c");
            }
    	}
    })
	
    $(".nav li").hover(function(){
		$(this).css("background","#eaeaea")
		$(this).children(".nav_ul").css('visibility','visible');
	},function(){
		$(this).css("background","none")
		$(this).children(".nav_ul").css('visibility','hidden');
	})

    //移动端导航点击事件
    $(".moblie_click_nav").toggle(function(){
        $(this).css("background","#eaeaea").css("color","#2e3b4e");
        $(".moblie_slide").slideDown();
    },function(){
        $(this).css("background","#2e3b4e").css("color","#fff");
        $(".moblie_slide").slideUp();
    })
	//移动端footer的点击事件
    $(".m_friend_div li").click(function(){
        var isshow=$(this).next(".showlist").css("display");
        $(".showlist").slideUp();
        if(isshow=='none')
        {
            $(this).next(".showlist").slideDown(); 
            $(this).find("a").find("span").css("background-position","-1px -424px");
        }
        else if(isshow=='block')
        {
            $(".showlist").slideUp();
            $(".m_friend_div li a span").css("background-position","0 -5px");
        }

    })

	$(".mobile_search").on("click",function(){
        var input = $(".mobile_search").find('input:text');
        if(input.is(':visible')) {
            return false;
        }

        if(window.screen.width<400)
        {
            $(this).addClass("addb");
            $(".moblie_logos").css("width","36%");
            $(this).css("width","36%");
            $(this).find("input").css("display","block");
        } else if(window.screen.width<490) {
            $(this).addClass("addb");
            $(".moblie_logos").css("width","35%");
            $(this).css("width","35%");
            $(this).find("input").css("display","block");
        } else {
            $(this).addClass("addb");
            $(".moblie_logos").css("width","35%");
            $(this).css("width","35%");
            $(this).find("input").css("display","block");
        }

        input.val('');
        $('span.s_click').trigger('click');
    })

	$(".m_navlist").toggle(function(){
        $(this).css("background","#2578b0");
        $(this).children("a").css("border-bottom","none");
		$(this).find("span img").attr("src",THEME+"images/d.png");
		$(this).next("li").find(".downdiv").slideDown();
	},function(){
        $(this).css("background","#4296cf");
        $(this).children("a").css("border-bottom","1px solid #66b0e2");
		$(this).find("span img").attr("src",THEME+"images/b.png");
		$(this).next("li").find(".downdiv").slideUp();
	})

    $("#search_BTN").on('click',function(){
        var input = $("#search_BTN").closest('span').find('input:text');
        if(input.is(':visible')) return false;

        $(this).parent(".nav_s").addClass("nav_bor");
        $(".nav_s input").css("display","block");

        input.val('');
        input.focus();
    })

    //大事件页面  点击年份跳到对应的年份事件
	$(".event_list").click(function(){
        $(".event_list").removeClass("newColor");
        $(this).addClass("newColor");
        var $datasrc=$(this).attr("data-src");
        var $isclass=$(".event_box").hasClass($datasrc);
        if($isclass)
        {
            var offsettops=$("."+$datasrc).offset().top;
            $("html,body").animate({scrollTop:offsettops},500)
        }
        
    })
    //移动端大事件页面  点击年份跳到对应的年份事件
    $(".m_event_list").click(function(){
        $(".m_event_list").removeClass("newColor");
        $(this).addClass("newColor");
        var $datasrc=$(this).attr("data-src");
        var $isclass=$(".event_box").hasClass($datasrc);
        if($isclass)
        {
            var offsettops=$("."+$datasrc).offset().top;
            $("html,body").animate({scrollTop:offsettops},500)
        }
        
    })

    //搜索框失去焦点时
    $(".s_input").blur(function(){
        if(!doblur) return false;
        $(".mobile_search").removeClass("addb").css("width","20%").css("text-indent","0");
        $(".s_input").css("display","none");
        $(".moblie_logos").css("width","60%").css("text-indent","6%");
    })

    $(".nav_s input").blur(function(){
        if(!doblur) return false;
        $(".nav_s").removeClass("nav_bor");
        $(this).css("display","none");
    })

    //
    $(".m_listleft_title").toggle(function(){
        $(this).next(".m_dropdown").slideDown();
    },function(){
        $(this).next(".m_dropdown").slideUp();
    });

    $(".m_listleft_title1").click(function(){
        //alert($(".m_dropdown1").css("display")=="none");
        if($(".m_dropdown1").css("display")=="none")
        {
            $(".m_dropdown1").css("display","block");
        }
        else
        {
            $(".m_dropdown1").css("display","none");
        }
                
    })
 
    // $(".active_span").click(function(){
    //     var activelim=$(this).attr("limer");
                
    //     $(".banner-pic").css("display","none");
    //     $("."+activelim).css("display","block");
    // })

    /*文章详情页分享*/
    $('.paper_share a').click(function(){
        $('.paper_share').hide();
    })
    /*文章页面分享*/
    $(".active_sharep").hover(function(){
        $(this).find(".article_share").show();
    },function(){
        $(this).find(".article_share").hide();
    })
    $('.article_share a').click(function(){
        $(this).closest('.article_share').hide();
    })
    $(".article_author").click(function(){
        if (document.body.clientWidth >= 1131) {
        	$(this).closest('.article_slidiv').children(".article_slidivshow").toggle();
        }
    })

	// $("#viewdiv").click(function(){
 //        $(".article_titles h1").removeClass("article_titles_cr");
 //        $(this).addClass("article_titles_cr");
 //        $("#view").css("display","block");
 //        $("#topic").css("display","none");
 //    })
	// $("#topicdiv").click(function(){
 //        $(".article_titles h1").removeClass("article_titles_cr");
 //        $(this).addClass("article_titles_cr");
 //        $("#view").css("display","none");
 //        $("#topic").css("display","block");
 //    })

    $(".changeimg").hover(function(){
        $(this).children("img").attr("src",THEME+"images/sh1.png");
    },function(){
        $(this).children("img").attr("src",THEME+"images/sh.png");
    })

    $(".active_bm .changeimg").hover(function(){
        $(this).find(".article_share").show();
    },function(){
        $(this).find(".article_share").hide();
    })

    $(window).on('scroll',function(){
        var Stop=$(window).scrollTop();

        if (screen.width < 1131)
        {
        $(".moblie_nav").css("position","fixed").css("top","0px").css("left","0px").css("width","100%").css("z-index","9999");
        //var s1=$(".m_listleft").offset().top;
        var Stop1=$(window).scrollTop();

        /*if(Stop1>s1)
        {
            $(".m_listleft").css("background","#fff").css("position","fixed").css("top","48px").css("left","0px").css("width","100%").css("z-index","9999");
        }*/

        if(Stop==0)
        {
            //alert("1");
           $(".moblie_nav").css("position","relative");
           //$(".m_listleft").css("position","relative").css("top","0");
        }

        //return false;
        }
    })
    
    $(".blog_share").hover(function(){
        $(this).children("img").attr("src",THEME+"images/sh1.png");
    },function(){
        $(this).children("img").attr("src",THEME+"images/sh.png");
    })
    $(".blog_share").hover(function(){
        $(this).find(".article_share").show();
    },function(){
        $(this).find(".article_share").hide();
    })

    $(".cer_title li").click(function(){
        $(".cer_title li").removeClass("cer_t_c");
        $(this).addClass("cer_t_c");
        var $datasrcs=$(this).attr("data-src");
        var $isclasss=$(".datasrc").hasClass($datasrcs);
        if($isclasss)
        {
            var offsettopss=($("."+$datasrcs).offset().top)-80;

            $("html,body").animate({scrollTop:offsettopss},500)
        }
    })

    $(".m_dropdown1 a").click(function(){
        $(".m_listleft_title1 i").text($(this).html());
        $(".m_dropdown1").css("display","none")
        $(this).addClass("cer_t_c");
        var $datasrcs1=$(this).attr("data-src");
        var $isclasss1=$(".datasrc").hasClass($datasrcs1);
        if($isclasss1)
        {
            var offsettopss1=($("."+$datasrcs1).offset().top)-80;

            $("html,body").animate({scrollTop:offsettopss1},500)
        }
    })

    $(".teach_ans").click(function(){
        var istrue =$(this).children("span").hasClass("isclass");
        //alert(istrue);
        if(istrue)
        {
            //alert("2");
            $(this).children("span").removeClass("isclass");
            $(this).next().slideUp();
        }
        else
        {
            //alert("1");
            $(this).children("span").addClass("isclass");
            $(this).next().slideDown();
        }

    })

    var bodyH=$(document).height();
    $(".pub_bg").css("height",bodyH+"px");
    $(".clickimg").click(function(){
		if(screen.width >= 1131)
		{
		 $(".pub_bg").css("display","block");
         $(".pub_box").css("display","block");
		}
       
    })
    $(".close_pub").click(function(){
        $(".pub_bg").css("display","none");
        $(".pub_box").css("display","none");
    })

    $("#online_ques").click(function(){
        //alert("2");
        $(".con_newbg").css("display","block")
    })

    $(".other_im a").hover(function(){
		$(this).children(".other_hidden").hide();
		$(this).children(".cer_b_h").show();
		
		},function(){
			$(this).children(".other_hidden").show();
		$(this).children(".cer_b_h").hide();
	})

    $(".clicktool").toggle(function(){
        $(this).next(".tool_code").show();
    },function(){
        $(this).next(".tool_code").hide();
    })

    $(".tool_small_img img").click(function(){
        var imgsrc=$(this).attr("src");
        var imgsrc1=imgsrc.split("/")[0];
        var imgsrc2=imgsrc.split("/")[1].split(".")[0];
        $(".tool_big_img img").attr("src",imgsrc1+"/"+imgsrc2+"_1.jpg");
    })

    // $(".book_box li").click(function(){
    //     $(".book_box li").removeClass("book_cur");
    //     $(this).addClass("book_cur");
    //     var datadiv=$(this).attr("datadiv");
    //     $(".book_alldiv").css("display","none");
    //     $("."+datadiv).css("display","block");
    // })
})