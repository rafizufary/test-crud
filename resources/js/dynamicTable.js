document.getElementById('addRow').addEventListener('click', function () {
    const tableBody = document.getElementById('tableBody');
    const rowCount = tableBody.rows.length + 1;

    const newRow = `
        <tr>
            <td>${rowCount}</td>
            <td><input type="text" name="course[]" placeholder="Enter Course" /></td>
            <td><input type="text" name="year[]" placeholder="Enter Year" /></td>
        </tr>
    `;
    tableBody.insertAdjacentHTML('beforeend', newRow);
});
