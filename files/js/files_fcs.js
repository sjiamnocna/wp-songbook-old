function toascii(s) {
    var j;
    var num = 0;

    for (i = 0; i < s.length; i = i + 1) {
        num = num + s.charCodeAt(i);
    }

    return num;
}
function extension(url) {
    return (url = url.substr(1 + url.lastIndexOf("/")).split('?')[0]).substr(url.lastIndexOf(".")).replace(".", "");
}
function filediv(type, title, url, id, private) {
    
    if(type.indexOf('url_')===-1){
        var exticon=extension(url);
        var type=exticon;
    } else {
        var exticon=type.replace('url_','');
        var type=exticon;
    }

    if (!id)
        return false;

    var ret = '<div class="file" id="file_' + id + '"><span class="exticon ' + exticon + '"></span><div class="maininfo"><p class="filetitle"><a id="href_' + id + '" href="' + url + '" target="_blanc">' + title + '</a><br/>\n';

    ret += '<input type="hidden" id="id_' + id + '" name="songbook[files][' + id + '][id]" value="' + id + '">\n';
    if (title)
        ret += '<input type="hidden" id="title_' + id + '" name="songbook[files][' + id + '][title]" value="' + title + '">\n';
    if (type)
        ret += '<input type="hidden" id="type_' + id + '" name="songbook[files][' + id + '][type]" value="' + type + '">\n';
    if (private)
        ret += '<input type="hidden" id="private_' + id + '" name="songbook[files][' + id + '][private]" value="' + private + '">\n';
    if (url)
        ret += '<input type="hidden" id="url_' + id + '" name="songbook[files][' + id + '][url]" value="' + url + '">\n';

        var lockclass=(private==='private')?'locked':'unlocked';

    ret += '<p class="toolbar">\n\
        <span class="toolspan">\n\
        <a class="textch" rel="' + id + '"></a>\n\
        <a class="lock '+lockclass+'" rel="' + id + '"></a>\n\
        <a class="remover" rel="' + id + '"></a>\n\
        </span>\n\
        </p>\n\
        </div>\n\
        </div>\n\
        </div>';

    jQuery("#obal").prepend(ret);
    
    if (jQuery(".nofile").text() !== 0)
                jQuery(".nofile").css('display', 'none');
}