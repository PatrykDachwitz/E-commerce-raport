export function setCommunicate(communicates, code) {

    let nextIdNumber = 1;

    if (communicates.length > 0) {
        nextIdNumber = communicates[communicates.length - 1].id + 1;
    }

    return {
        id: nextIdNumber,
        code: code,
    };
}
