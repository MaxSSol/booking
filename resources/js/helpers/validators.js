import { helpers } from "@vuelidate/validators"

const ukTelNum = helpers.regex(/^([+]{0,1}380)\d{9}$/)

export { ukTelNum }
