/**
 * @returns Promise
 */
export function fetchProducts() {
    return new Promise((resolve, reject) => {
        resolve({
            data: {
                'data': window.products,
            },
        });
    });
}
