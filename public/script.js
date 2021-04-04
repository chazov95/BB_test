function showProductForm(value) {
    let credit = $('#credit');
    let deposit = $('#deposit');

    switch (value) {
        case 'credit':
            credit.show();
            deposit.hide();
            setRemoveDisable(credit, deposit);
            break;
        case 'deposit':
            credit.hide();
            deposit.show();
            setRemoveDisable(deposit, credit);
            break;
    }
}

function showClientForm(value) {
    let natural =$('#natural');
    let legal = $('#legal')

    switch (value) {
        case 'natural':
            $('#natural').show();
            $('#legal').hide();
            setRemoveDisable(natural, legal);
            break;
        case 'legal':
            $('#natural').hide();
            $('#legal').show();
            setRemoveDisable(legal,natural);
            break;
    }
}

function setRemoveDisable(set, remove) {
    set.children().each(function () {
        $(this).attr('disabled', false)
    })
    remove.children().each(function () {
        $(this).attr('disabled', true)
    })
}
