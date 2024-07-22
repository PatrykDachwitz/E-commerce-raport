export function insertSpace(text) {

    let reversedInput = text.toString().split('').reverse().join('');
    let spacedReversedInput = reversedInput.replace(/(\d{3})/g, '$1 ').trim();
    return spacedReversedInput.split('').reverse().join('');
}
