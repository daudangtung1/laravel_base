import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useFaqs() {
    const faqs = ref([]);
    const faq = ref({});

    const errors = ref("");
    const router = useRouter();

    const getFaqs = async () => {
        let response = await axios.get("http://127.0.0.1:8000/api/v1/faqs/");
        faqs.value = response.data.data;
    };

    const getFaq = async (id) => {
        let response = await axios.get("http://127.0.0.1:8000/api/v1/faqs/" + id);
        faq.value = response.data.data;
    };

    return {
        errors,
        faqs,
        faq,
        getFaqs,
        getFaq,
    }
}
