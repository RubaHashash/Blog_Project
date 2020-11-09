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
        await fetch('/post/comment', {
            method: 'POST',
            body: jsonBody,
            headers: {
                'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
    }

    async display_comments(id){
        let jsonBody = JSON.stringify({'id': id});
        let response= await fetch('/post/display_comments', {
            method: 'POST',
            body: jsonBody,
            headers: {
                'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
        // console.log(response.json());
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


async function commentPost(id){

    let comment = document.getElementById("comment_input"+id);
    let commentValue = comment.value;
    
    await service.comment(id, commentValue);
    
    comment.value = '';

    //display comments
    let result= await service.display_comments(id);

    let div = document.getElementById("comment_div"+id);
    let inner_div = document.createElement('div');
    div.innerHTML='';
    result.forEach((element) => {

    let hr = document.createElement('hr');
    let myDiv = document.createElement('div');

    let name_user = document.createElement('label');
    name_user.innerText=element.name;

    let comment_created = document.createElement('span');
    comment_created.innerText = new Date(element.created_at).toLocaleString('en-GB', { timeZone: 'UTC' });
    comment_created.style.float = 'right';

    let comment_label = document.createElement('span');
    comment_label.innerText=element.text;
        
    inner_div.appendChild(hr);
    myDiv.appendChild(name_user);
    myDiv.appendChild(comment_created);
    inner_div.appendChild(myDiv);
    inner_div.appendChild(comment_label);

    });
    div.appendChild(inner_div);
}


async function displayCommentFunction(id){
        
    //display comments
        let result= await service.display_comments(id);

        let div = document.getElementById("comment_div"+id);
        let inner_div = document.createElement('div');
        div.innerHTML='';
        result.forEach((element) => {
    
        let hr = document.createElement('hr');
        let myDiv = document.createElement('div');
    
        let name_user = document.createElement('label');
        name_user.innerText=element.name;
    
        let comment_created = document.createElement('span');
        comment_created.innerText = new Date(element.created_at).toLocaleString('en-GB', { timeZone: 'UTC' });
        comment_created.style.float = 'right';
    
        let comment_label = document.createElement('span');
        comment_label.innerText=element.text
            
        inner_div.appendChild(hr);
        myDiv.appendChild(name_user);
        myDiv.appendChild(comment_created);
        inner_div.appendChild(myDiv);
        inner_div.appendChild(comment_label);
    
        });
        div.appendChild(inner_div);
}




// for comment div
function myFunction(id) {
    
    displayCommentFunction(id);

    var x = document.getElementById("add_comment"+id);
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
}


