// Sample data for messages or announcements
const messagesOrAnnouncements = [
    {
        sender: "John",
        message: "Hi there!",
        timestamp: "1 hour ago"
    },
    {
        sender: "Alice",
        message: "Hello, how can I help you?",
        timestamp: "2 hours ago"
    },
    {
        sender: "Bob",
        message: "I have a question about the project.",
        timestamp: "3 hours ago"
    }
    // Add more messages or announcements as needed
];

// Function to display messages or announcements on the page
function displayMessagesOrAnnouncements() {
    const messageList = document.getElementById("messageList");

    messagesOrAnnouncements.forEach(item => {
        const listItem = document.createElement("li");
        listItem.innerHTML = `<strong>${item.sender}</strong><p>${item.message}</p><small>${item.timestamp}</small>`;
        messageList.appendChild(listItem);
    });
}

// Call the function to display messages or announcements
displayMessagesOrAnnouncements();
