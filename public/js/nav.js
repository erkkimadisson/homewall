function toggleCategory(categoryId) {
    const category = document.getElementById(categoryId);
    const icon = document.getElementById(`${categoryId}-caret`)
    const button = document.getElementById(`${categoryId}-button`)

    category.classList.toggle('hidden');
    button.classList.toggle('rounded-tl-md')
    button.classList.toggle('rounded-tr-md')
    button.classList.toggle('rounded-bl-none')
    button.classList.toggle('rounded-br-none')
    button.classList.toggle('border-b-0')
    icon.classList.toggle('fa-angle-down');
    icon.classList.toggle('fa-angle-up');
}