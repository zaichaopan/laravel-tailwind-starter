export const pick = (obj, keyArray) => {
  let newObj = {}
  keyArray.forEach(item => {
    if (typeof item === 'string') {
      newObj[item] = obj[item]
      return
    }

    if (typeof item === 'object') {
      Object.keys(item).forEach(itemKey => {
        if (typeof item[itemKey] === 'string') {
          newObj[item[itemKey]] = obj[itemKey]
          return
        }

        if (typeof item[itemKey] === 'function') {
          newObj[itemKey] = item[itemKey]()
        }
      })
    }
  })

  return newObj
}
