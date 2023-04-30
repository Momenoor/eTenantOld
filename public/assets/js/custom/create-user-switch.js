
if ($('[name=create_user_switch]').length > 0) {
    crud.field('create_user_switch').onChange(function (field) {
        crud.field('user.name').show(field.value == 1).enable(field.value == 1);
        crud.field('user.email').show(field.value == 1).enable(field.value == 1);
    }).change();
}
