var ddaccordion={ajaxloadingmsg:'<img src="/loading2.gif" /><br />Loading Content...',headergroup:{},contentgroup:{},preloadimages:function(e){e.each(function(){var e=new Image;e.src=this.src})},expandone:function(e,t,n){this.toggleone(e,t,"expand",n)},collapseone:function(e,t){this.toggleone(e,t,"collapse")},expandall:function(e){var t=this.headergroup[e];this.contentgroup[e].filter(":hidden").each(function(){t.eq(parseInt($(this).attr("contentindex"))).trigger("evt_accordion")})},collapseall:function(e){var t=this.headergroup[e];this.contentgroup[e].filter(":visible").each(function(){t.eq(parseInt($(this).attr("contentindex"))).trigger("evt_accordion")})},toggleone:function(e,t,n,r){var i=this.headergroup[e].eq(t);var s=this.contentgroup[e].eq(t);if(typeof n=="undefined"||n=="expand"&&s.is(":hidden")||n=="collapse"&&s.is(":visible"))i.trigger("evt_accordion",[false,r])},ajaxloadcontent:function(e,t,n,r){function s(e){if(e){i.cacheddata=e;i.status="cached";if(t.queue("fx").length==0){t.hide().html(e);i.status="complete";r()}}if(i.status!="complete"){setTimeout(function(){s(i.cacheddata)},100)}}var i=e.data("ajaxinfo");if(i.status=="none"){t.html(this.ajaxloadingmsg);t.slideDown(n.animatespeed);i.status="loading";$.ajax({url:i.url,error:function(e){s("Error fetching content. Server Response: "+e.responseText)},success:function(e){e=e==""?" ":e;s(e)}})}else if(i.status=="loading")s(i.cacheddata)},expandit:function(e,t,n,r,i,s,o){var u=e.data("ajaxinfo");if(u){if(u.status=="none"||u.status=="loading")this.ajaxloadcontent(e,t,n,function(){ddaccordion.expandit(e,t,n,r,i)});else if(u.status=="cached"){t.html(u.cacheddata);u.cacheddata=null;u.status="complete"}}this.transformHeader(e,n,"expand");t.slideDown(s?0:n.animatespeed,function(){n.onopenclose(e.get(0),parseInt(e.attr("headerindex")),t.css("display"),r);if(o){var s=n["collapseprev"]?20:0;clearTimeout(n.sthtimer);n.sthtimer=setTimeout(function(){ddaccordion.scrollToHeader(e)},s)}if(n.postreveal=="gotourl"&&i){var u=e.is("a")?e.get(0):e.find("a:eq(0)").get(0);if(u)setTimeout(function(){location=u.href},200+(o?400+s:0))}})},scrollToHeader:function(e){ddaccordion.$docbody.stop().animate({scrollTop:e.offset().top},400)},collapseit:function(e,t,n,r){this.transformHeader(e,n,"collapse");t.slideUp(n.animatespeed,function(){n.onopenclose(e.get(0),parseInt(e.attr("headerindex")),t.css("display"),r)})},transformHeader:function(e,t,n){e.addClass(n=="expand"?t.cssclass.expand:t.cssclass.collapse).removeClass(n=="expand"?t.cssclass.collapse:t.cssclass.expand);if(t.htmlsetting.location=="src"){e=e.is("img")?e:e.find("img").eq(0);e.attr("src",n=="expand"?t.htmlsetting.expand:t.htmlsetting.collapse)}else if(t.htmlsetting.location=="prefix")e.find(".accordprefix").empty().append(n=="expand"?t.htmlsetting.expand:t.htmlsetting.collapse);else if(t.htmlsetting.location=="suffix")e.find(".accordsuffix").empty().append(n=="expand"?t.htmlsetting.expand:t.htmlsetting.collapse)},urlparamselect:function(e){var t=window.location.search.match(new RegExp(e+"=((\\d+)(,(\\d+))*)","i"));if(t!=null)t=RegExp.$1.split(",");return t},getCookie:function(e){var t=new RegExp(e+"=[^;]+","i");if(document.cookie.match(t))return document.cookie.match(t)[0].split("=")[1];return null},setCookie:function(e,t){document.cookie=e+"="+t+"; path=/"},init:function(e){document.write('<style type="text/css">\n');document.write("."+e.contentclass+"{display: none}\n");document.write("a.hiddenajaxlink{display: none}\n");document.write("</style>");jQuery(document).ready(function(t){ddaccordion.urlparamselect(e.headerclass);var n=ddaccordion.getCookie(e.headerclass);ddaccordion.headergroup[e.headerclass]=t("."+e.headerclass);ddaccordion.contentgroup[e.headerclass]=t("."+e.contentclass);ddaccordion.$docbody=window.opera?document.compatMode=="CSS1Compat"?jQuery("html"):jQuery("body"):jQuery("html,body");var r=ddaccordion.headergroup[e.headerclass];var i=ddaccordion.contentgroup[e.headerclass];e.cssclass={collapse:e.toggleclass[0],expand:e.toggleclass[1]};e.revealtype=e.revealtype||"click";e.revealtype=e.revealtype.replace(/mouseover/i,"mouseenter");if(e.revealtype=="clickgo"){e.postreveal="gotourl";e.revealtype="click"}if(typeof e.togglehtml=="undefined")e.htmlsetting={location:"none"};else e.htmlsetting={location:e.togglehtml[0],collapse:e.togglehtml[1],expand:e.togglehtml[2]};e.oninit=typeof e.oninit=="undefined"?function(){}:e.oninit;e.onopenclose=typeof e.onopenclose=="undefined"?function(){}:e.onopenclose;var s={};var o=ddaccordion.urlparamselect(e.headerclass)||(e.persiststate&&n!=null?n:e.defaultexpanded);if(typeof o=="string")o=o.replace(/c/ig,"").split(",");if(o.length==1&&o[0]=="-1")o=[];if(e["collapseprev"]&&o.length>1)o=[o.pop()];if(e["onemustopen"]&&o.length==0)o=[0];r.each(function(n){var r=t(this);if(/(prefix)|(suffix)/i.test(e.htmlsetting.location)&&r.html()!=""){t('<span class="accordprefix"></span>').prependTo(this);t('<span class="accordsuffix"></span>').appendTo(this)}r.attr("headerindex",n+"h");i.eq(n).attr("contentindex",n+"c");var u=i.eq(n);var a=u.find("a.hiddenajaxlink:eq(0)");if(a.length==1){r.data("ajaxinfo",{url:a.attr("href"),cacheddata:null,status:"none"})}var f=typeof o[0]=="number"?n:n+"";if(jQuery.inArray(f,o)!=-1){ddaccordion.expandit(r,u,e,false,false,!e.animatedefault);s={$header:r,$content:u}}else{u.hide();e.onopenclose(r.get(0),parseInt(r.attr("headerindex")),u.css("display"),false);ddaccordion.transformHeader(r,e,"collapse")}});r.bind("evt_accordion",function(n,r,o){var u=i.eq(parseInt(t(this).attr("headerindex")));if(u.css("display")=="none"){ddaccordion.expandit(t(this),u,e,true,r,false,o);if(e["collapseprev"]&&s.$header&&t(this).get(0)!=s.$header.get(0)){ddaccordion.collapseit(s.$header,s.$content,e,true)}s={$header:t(this),$content:u}}else if(!e["onemustopen"]||e["onemustopen"]&&s.$header&&t(this).get(0)!=s.$header.get(0)){ddaccordion.collapseit(t(this),u,e,true)}});r.bind(e.revealtype,function(){if(e.revealtype=="mouseenter"){clearTimeout(e.revealdelay);var n=parseInt(t(this).attr("headerindex"));e.revealdelay=setTimeout(function(){ddaccordion.expandone(e["headerclass"],n,e.scrolltoheader)},e.mouseoverdelay||0)}else{t(this).trigger("evt_accordion",[true,e.scrolltoheader]);return false}});r.bind("mouseleave",function(){clearTimeout(e.revealdelay)});e.oninit(r.get(),o);t(window).bind("unload",function(){r.unbind();var n=[];i.filter(":visible").each(function(e){n.push(t(this).attr("contentindex"))});if(e.persiststate==true&&r.length>0){n=n.length==0?"-1c":n;ddaccordion.setCookie(e.headerclass,n)}})})}};ddaccordion.preloadimages(jQuery(ddaccordion.ajaxloadingmsg).filter("img"))