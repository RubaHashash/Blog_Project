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


    async comment(id,comment_input) {
        let jsonBody = JSON.stringify({'id': id, 'text': comment_input});
        await fetch('post/comment', {
            method: 'POST',
            body: jsonBody,
            headers: {
                'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
    }
}

let service = new Service();

async function likePost(id){
    
    await service.like(id);

    let res= await service.like_count(id);
    let div=document.getElementById("count"+id);
    div.innerText=res;
}


async function commentPost(id, comment_input){

    await service.comment(id, comment_input);

    let comment = document.getElementById("comment_input"+id);
    comment.value = '';

}



// for comment div
function myFunction() {
    var x = document.getElementById("add_comment");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }