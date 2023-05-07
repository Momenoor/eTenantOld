
if ($('[name=create_user_switch]').length > 0) {
    crud.field('create_user_switch').onChange(function (field) {
        crud.field('user.name').show(field.value == 1).enable(field.value == 1)
        crud.field('user.name').input.value = crud.field('name').value;
        crud.field('user.email').show(field.value == 1).enable(field.value == 1);
        crud.field('user.email').input.value = crud.field('email').value;
    }).change();
}
