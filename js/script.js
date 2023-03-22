function exportExcel() {
    axios.get('/apps/kmausermanager/all_kma_user')
      .then(response => {
        const data = response.data;
  
        // Convert the data to an Excel workbook
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(data);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
  
        // Save the workbook as an Excel file
        XLSX.writeFile(workbook, 'export.xlsx');
      })
      .catch(error => {
        console.error(error);
      });
  }
  