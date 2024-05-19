document.addEventListener("DOMContentLoaded", function () {
    // Create the message box and elements
    var messageBox = document.createElement("div");
    messageBox.className = "message-box";

    var messageContent = document.createElement("div");
    messageContent.className = "message-content";

    var messageText = document.createElement("p");
    messageText.textContent = jsMessageText; // Use the JavaScript variable directly

    var closeButton = document.createElement("button");
    closeButton.textContent = "Close";
    closeButton.className = "close-button";
    closeButton.addEventListener("click", function () {
        closeMessageBox();
    });

    messageContent.appendChild(messageText);
    messageContent.appendChild(closeButton);
    messageBox.appendChild(messageContent);
    document.body.appendChild(messageBox);

    // Function to close the message box
    function closeMessageBox() {
        document.body.removeChild(messageBox);
    }

    // Event listener for Enter key press anywhere on the page
    document.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            closeMessageBox();
        }
    });
});
