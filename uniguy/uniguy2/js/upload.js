jQuery.noConflict();

function ashu_preview_pic()
{
    jQuery('.upload_pic_input').each(function()
    {
        jQuery(this).bind('change focus blur ktrigger', function()
        {   
            
            $select = '#' + jQuery(this).attr('name') + '_div';
            $value = jQuery(this).val();
            $image = '<img src ="'+$value+'" />';
                        
            var $image = jQuery($select).html('').append($image).find('img');
            
            //set timeout because of safari
            window.setTimeout(function()
            {
                if(parseInt($image.attr('width')) < 20)
                {   
                    jQuery($select).html('');
                }
            },500);
        });
    });
}

function ashu_media_uploader()
{       
        $buttons = jQuery('.k_hijack');
        $realmediabuttons = jQuery('.media-buttons a');
        
        
        window.custom_editor = false;
        
        // set a variable depending on what has been clicked, normal media uploader or kriesi hijacked uploader
        $buttons.click(function()
        {   
            window.custom_editor = jQuery(this).attr('id');         
        });
        
        $realmediabuttons.click(function()
        {
            window.custom_editor = false;
        });

        window.original_send_to_editor = window.send_to_editor;
        window.send_to_editor = function(html)
        {   
            
            if (custom_editor) 
            {   
                $img = jQuery(html).attr('src') || jQuery(html).find('img').attr('src') || jQuery(html).attr('href');
                
                jQuery('input[name='+custom_editor+']').val($img).trigger('ktrigger');
                custom_editor = false;
                window.tb_remove();
            }
            else 
            {
                window.original_send_to_editor(html);
            }
        };
}

function duplicate_slider_cat()
{   
    var $dropdown_wrap = jQuery('.multiple_box');
    
    $dropdown_wrap.each(function()
    {           
        var $dropdown = jQuery(this).find('.multiply_me');
        var $current_dropdown_wrapper = jQuery(this);
        
            $dropdown.each(function(i)
            {
            $name = jQuery(this).attr('name').replace(/\d+$/,"");
            jQuery(this).attr('id', $name + i);
            jQuery(this).attr('name', $name + i);
            jQuery('.'+$name+'hidden').attr('value', $dropdown.length);
        
            jQuery(this).unbind('change').bind('change',function()
            {
                if(jQuery(this).val() && $dropdown.length == i+1)
                {
                jQuery(this).clone().appendTo($current_dropdown_wrapper);
                duplicate_slider_cat();
                }
                else if(!(jQuery(this).val()) && !($dropdown.length == i+1))
                {
                jQuery(this).remove();
                duplicate_slider_cat();
            }
            
            });
        });
    });
}
function copy_table()
{
    var $multitable_wrap = jQuery('.multitables');
    
    $multitable_wrap.each(function()
    {
        var $add_next = jQuery(this).find('.add_table');
        var $del_this = jQuery(this).find('.del_table');
        var $count = jQuery(this).find('.malltype_count');
        var $current_table = jQuery(this);
        
        $add_next.unbind('click').bind('click',function()
            {
            //cont.val() value+1
            $count.val(parseInt($count.val())+1);
            $current_number = $count.val();
            $newclone = jQuery('.clone_me').clone().insertBefore(jQuery('.clone_me'));
            $newclone.removeClass('hidden').removeClass('clone_me');
            
            _helper_correct_numbers($current_table)
            duplicate_slider_cat();
            copy_table();
            
            return false;
            });
            
        $del_this.unbind('click').bind('click',function()
            {
            $count.val(parseInt($count.val())-1);
            jQuery(this).parents('.multitable').remove();
            _helper_correct_numbers($current_table);
            return false;
            });
        
        
    });
    
}

function _helper_correct_numbers($current_table)
{
    $current_table.find('.multitable').each(function(i){
        var $current_sub_table = jQuery(this);
        $current_sub_table.find('.changenumber').html(i+1);
        $current_sub_table.find('.changeable').each(function(){
                var $multiply_me = '';
                var $newname = jQuery(this).attr('name').replace(/\d+/,i);
                if (jQuery(this).hasClass('multiply_me')) $multiply_me = 'multiply_me';
                jQuery(this).attr({'name': $newname,'id': $newname, 'class': $newname + " changeable " + $multiply_me});
            });
    });
}

jQuery(document).ready(function()
{   
    ashu_media_uploader();
    ashu_preview_pic();
    copy_table();
});