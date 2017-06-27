/**
 * Created by Admin on 6/11/2017.
 */

function submitbutton(pressbutton) {
    submitform(pressbutton);
}
/**
 * Submit the admin form
 */
function submitform(pressbutton){
    if (pressbutton) {
        document.adminForm.task.value=pressbutton;
    }
    /*if (typeof document.adminForm.onsubmit == "function") {
     document.adminForm.onsubmit();
     }*/
    document.adminForm.submit();
}

/*
 * Check checkbox
 */
function isChecked(isitchecked){
    if (isitchecked == true){
        document.adminForm.boxchecked.value++;
    }
    else {
        document.adminForm.boxchecked.value--;
    }
}
function checkAll( n, fldName ) {
    if (!fldName) {
        fldName = 'cb';
    }
    var f = document.adminForm;
    var c = f.toggle.checked;
    var n2 = 0;
    for (i=0; i < n; i++) {
        cb = eval( 'f.' + fldName + '' + i );
        if (cb) {
            cb.checked = c;
            n2++;
        }
    }
    if (c) {
        document.adminForm.boxchecked.value = n2;
    } else {
        document.adminForm.boxchecked.value = 0;
    }
}
/*dùng cho publish và unpublish*/
function listItemTask(id, task)
{
    var f = document.adminForm;
    cb = eval( 'f.' + id );
    if (cb) {
        for (i = 0; true; i++) {
            cbx = eval('f.cb'+i);
            if (!cbx) break;
            cbx.checked = false;
        } // for
        cb.checked = true;
        f.boxchecked.value = 1;
        submitbutton(task);
    }
    return false;
}

/*
 * Ordering
 */
function tableOrdering( order, dir, task ) {
    var form = document.adminForm;
    form.sort_field.value 	= order;
    form.sort_direct.value	= dir;
    submitform( task );
}
