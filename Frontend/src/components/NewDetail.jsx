import { useParams } from 'react-router-dom';
import { useState, useEffect } from 'react';

const NewsDetail = () => {
    const { id } = useParams();  // Lấy id từ URL
    const [newsItem, setNewsItem] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchNewsDetail = async () => {
            try {
                const response = await fetch(`https://your-api.com/news/${id}`);
                if (!response.ok) {
                    throw new Error('Không thể lấy dữ liệu');
                }
                const data = await response.json();
                setNewsItem(data);
            } catch (err) {
                setError(err.message);
            } finally {
                setLoading(false);
            }
        };

        fetchNewsDetail();
    }, [id]);

    if (loading) return <div>Đang tải...</div>;
    if (error) return <div>Lỗi: {error}</div>;
    if (!newsItem) return <div>Không tìm thấy bài viết.</div>;

    return (
        <div className="news-detail">
            <h1>{newsItem.title}</h1>
            <img src={newsItem.image} alt={newsItem.title} className="w-full h-48 object-cover rounded-md mb-4" />
            <p>{newsItem.content}</p> {/* Đảm bảo rằng `newsItem.content` có dữ liệu */}
        </div>
    );
};

export default NewsDetail;
