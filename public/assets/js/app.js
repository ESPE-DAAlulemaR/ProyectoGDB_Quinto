function hideMenu() {
    let sidebar = $('.custom-aside').first().find('.sidebar')[0];

    sidebar.style.display = 'none';
}

function showMenu() {
    let sidebar = $('.custom-aside').first().find('.sidebar')[0];

    sidebar.removeAttr('style');
}

function hideLoginCardFooter() {
    let footer = $('.login-box').first()
        .find('.card').first()
        .find('.card-footer').first()
    ;

    footer = footer[0];

    footer.style.display = 'none';
}
