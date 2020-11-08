class Service{
    async like(id) {
        let jsonBody = JSON.stringify({'id': id});
        await fetch('/post/like', {
            method: 'POST',
            body: jsonBody,
            headers: {
                'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
    }


    async like_count(id){
        let jsonBody = JSON.stringify({'id': id});
       let response= await fetch('/post/count_like', {
            method: 'POST',
            body: jsonBody,
            headers: {
                'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
        return response.json();
    }
}

let service = new Service();

async function likePost(id){
    
    await service.like(id);

    let res= await service.like_count(id);
    let div=document.getElementById("count"+id);
    div.innerText=res;
}


function myFunction() {
    var x = document.getElementById("add_comment");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }