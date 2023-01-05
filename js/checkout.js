const stripe = Stripe("pk_test_51KzHTmFIeo8lkpejZT0I34XCllS6J6C93X7oOMh1YuXGrKZ0fJaWzIxYOtASzNkqq9qddeDb7q6wvfq1srD7MeoO00Xo3URP7v")

var jobID = document.getElementById('application_id').value;
var jobTitle = document.getElementById('title').value;
var totalPayment = document.getElementById('total').value;
var freelancerUsername = document.getElementById('f_username').value;

const btn = document.querySelector('#pay')

var bidPriceAmount = totalPayment.replaceAll('.', '');

btn.addEventListener('click', ()=>{
    fetch('server-payment.php',{
        method:"POST",
        headers:{
            'Content-Type' : 'application/json',
        },
        body: JSON.stringify({job_id: jobID, job_title:jobTitle, bid: bidPriceAmount, f_username: freelancerUsername})
    }).then(res=> res.json())
    .then(payload => {
        stripe.redirectToCheckout({sessionId: payload.id})
    })
})