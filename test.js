// let basePrice =415;
// for(let i=1; i<=10; i++){
//     newPrice = 
//     console.log( `price ${i} is ${basePrice+126}`)
// }
let basePrice = 415;
let newPrice = basePrice;

for(let i = 1; i <= 10; i++){
    console.log(`Price ${i} is ${newPrice} per person ${newPrice/i}`);
    newPrice += 126;  // Add 126 to the price for the next iteration
}
