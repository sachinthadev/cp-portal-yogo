
export async function fetchPost(url, data) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
            credentials: 'same-origin'
        });

        if (!response.ok) throw new Error('Network response was not ok');

        return await response.json();
    } catch (error) {
        console.error('fetchPost error:', error);
        return { status: 1, data: { status: 1, message: 'Request failed', error: error.message } };
    }
}

export async function fetchRequest(url) {
    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
            credentials: 'same-origin'
        });

        if (!response.ok) throw new Error('Network response was not ok');

        return await response.json();
    } catch (error) {
        console.error('fetchRequest error:', error);
        return { status: 1, data: { status: 1, message: 'Request failed', error: error.message } };
    }
}







































//  export function fetchPost (url,bodyData) {
//      return fetch(url, {
//         method: 'POST', // or 'PUT'
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify(bodyData),
//     })
//         .then((response) => response.json())
//         .then((data) => {

//             const returnVal = {
//                 status: 0,
//                 data: data
//             };
//             return returnVal;
//         })
//         .catch((error) => {
//             console.error('Error:', error);
//             const returnVal = {
//                 status: 1,
//                 data: error
//             };
//             return returnVal;
//         });
// }