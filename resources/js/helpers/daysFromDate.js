export default (dateFrom, dateTo) => {
    let date1 = new Date(dateFrom)
    let date2 = new Date(dateTo)
    const oneDay = 1000 * 60 * 60 * 24
    let diff = date2.getTime() - date1.getTime()
    return Math.round(diff/oneDay)
}
