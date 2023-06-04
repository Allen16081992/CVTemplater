var resumeItems = document.querySelectorAll("#resumeList li");

resumeItems.forEach(function (item) {
  item.addEventListener("click", function (event) {
    event.preventDefault();
    var selectedTitle = item.getAttribute("data-resume-title");

    // Make an Ajax request and pass the action parameter
    $.ajax({
      url: "ajax_handler.php",
      method: "POST",
      data: { action: "selectResumeInfo", title: selectedTitle }, // Specify the action and other parameters
      success: function (response) {
        // Handle the response from the server
        console.log(response);
      },
      error: function (xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });
  });
});