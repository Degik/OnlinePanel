document.getElementById('login').addEventListener('submit', function(event) {
    event.preventDefault();
    // Get the username and password
    const username = (document.getElementById('username') as HTMLInputElement).value;
    const password = (document.getElementById('password') as HTMLInputElement).value;
    
    // Get the error element
    const error = document.getElementById('error') as HTMLParagraphElement;
    
    // Send a POST request
});

function validate(username: string, password: string): boolean {
       
}